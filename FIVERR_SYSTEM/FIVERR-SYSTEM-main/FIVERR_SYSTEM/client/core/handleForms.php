<?php
require_once '../classloader.php';

if (isset($_POST['insertNewUserBtn'])) {
	$username = htmlspecialchars(trim($_POST['username']));
	$email = htmlspecialchars(trim($_POST['email']));
	$contact_number = htmlspecialchars(trim($_POST['contact_number']));
	$password = trim($_POST['password']);
	$confirm_password = trim($_POST['confirm_password']);

	if (!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password)) {

		if ($password == $confirm_password) {

			if (!$userObj->usernameExists($username)) {

				if ($userObj->registerUser($username, $email, $password, $contact_number)) {
					header("Location: ../login.php");
				} else {
					$_SESSION['message'] = "An error occured with the query!";
					$_SESSION['status'] = '400';
					header("Location: ../register.php");
				}
			} else {
				$_SESSION['message'] = $username . " as username is already taken";
				$_SESSION['status'] = '400';
				header("Location: ../register.php");
			}
		} else {
			$_SESSION['message'] = "Please make sure both passwords are equal";
			$_SESSION['status'] = '400';
			header("Location: ../register.php");
		}
	} else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../register.php");
	}
}

if (isset($_POST['loginUserBtn'])) {
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

	if (!empty($email) && !empty($password)) {

		if ($userObj->loginUser($email, $password)) {
			header("Location: ../index.php");
		} else {
			$_SESSION['message'] = "Username/password invalid";
			$_SESSION['status'] = "400";
			header("Location: ../login.php");
		}
	} else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../login.php");
	}

}

if (isset($_GET['logoutUserBtn'])) {
	$userObj->logout();
	header("Location: ../../index.php");
}

if (isset($_POST['updateUserBtn'])) {
	$contact_number = htmlspecialchars($_POST['contact_number']);
	$bio_description = htmlspecialchars($_POST['bio_description']);
	if ($userObj->updateUser($contact_number, $bio_description, $_SESSION['user_id'])) {
		header("Location: ../profile.php");
	}
}

if (isset($_POST['insertOfferBtn'])) {
	$user_id = $_SESSION['user_id'];
	$proposal_id = $_POST['proposal_id'];
	$description = htmlspecialchars($_POST['description']);
	if ($offerObj->createOffer($user_id, $description, $proposal_id)) {
		header("Location: ../index.php");
	}
}

if (isset($_POST['updateOfferBtn'])) {
	$description = htmlspecialchars($_POST['description']);
	$offer_id = $_POST['offer_id'];
	if ($offerObj->updateOffer($description, $offer_id)) {
		$_SESSION['message'] = "Offer updated successfully!";
		$_SESSION['status'] = '200';
		header("Location: ../index.php");
	}
}

if (isset($_POST['deleteOfferBtn'])) {
	$offer_id = $_POST['offer_id'];
	if ($offerObj->deleteOffer($offer_id)) {
		$_SESSION['message'] = "Offer deleted successfully!";
		$_SESSION['status'] = '200';
		header("Location: ../index.php");
	}
}

if (isset($_POST['addCategoryBtn'])) {
	$categoryName = $_POST['category'] ?? '';
	$subcategories = $_POST['subcategories'] ?? [];

	// Normalize category
	$normalizedName = $categoryObj->normalizeName($categoryName);

	// Normalize subcategories
	$normalizedSubs = [];
	foreach ($subcategories as $sub) {
		$sub = trim($sub);
		if ($sub !== '') {
			$normalizedSubs[] = $categoryObj->normalizeName($sub);
		}
	}


	$existingCategory = $categoryObj->getCategoryByName($normalizedName);

	if ($existingCategory) {
		// Category exists → just add new subcategories
		$categoryId = $existingCategory['category_id'];

		foreach ($normalizedSubs as $sub) {
			// ✅ Check if subcategory already exists under this category
			$existingSub = $categoryObj->getSubcategoryByName($categoryId, $sub);
			if (!$existingSub) {
				$categoryObj->addSubcategory($categoryId, $sub);
			}
		}

		$_SESSION['message'] = "Category '$normalizedName' already exists. Added subcategories instead.";
	} else {
		// Create category and get its ID
		if ($categoryObj->createCategory($normalizedName)) {
			$categoryId = $categoryObj->lastInsertId();

			// Add subcategories
			foreach ($normalizedSubs as $sub) {
				$sub = trim($sub);
				if ($sub !== '') {
					$categoryObj->addSubcategory($categoryId, $sub);
				}
			}
			$_SESSION['message'] = "Category '$normalizedName' and its subcategories were added successfully.";
		} else {
			$_SESSION['message'] = "Failed to create category.";
		}
	}


	header("Location: ../system.php");
}