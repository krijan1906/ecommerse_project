<?php
include '../configuration/database_connection.php';

// ── Handle POST (form submission from modal) ──
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id          = intval($_POST['id']);
    $name        = $conn->real_escape_string(trim($_POST['product_name']));
    $price       = floatval($_POST['price']);
    $old_price   = floatval($_POST['old_price']);
    $category    = $conn->real_escape_string(trim($_POST['category']));
    $description = $conn->real_escape_string(trim($_POST['description']));

    // ── Handle optional image upload ──
    $image_sql = '';
    if (!empty($_FILES['image']['name'])) {
        $allowed    = ['image/jpeg', 'image/png', 'image/webp'];
        $mime       = mime_content_type($_FILES['image']['tmp_name']);

        if (!in_array($mime, $allowed)) {
            die("Invalid image type.");
        }
        if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            die("Image too large (max 5MB).");
        }

        $ext        = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename   = 'uploads/' . uniqid('prod_', true) . '.' . $ext;
        $dest       = __DIR__ . '/' . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
            $image_sql = ", image = '$filename'";
        }
    }

    $sql = "UPDATE product_detail 
            SET product_name = '$name',
                price        = '$price',
                old_price    = '$old_price',
                category     = '$category',
                description  = '$description'
                $image_sql
            WHERE id = '$id'";

    if ($conn->query($sql)) {
        header("Location: ../template/adminside.php?tab=products&success=updated");
        exit();
    } else {
        die("Error updating product: " . $conn->error);
    }
}

// ── Handle GET ?update_product=ID (edit button link) ──
// The admin panel opens the modal via JS (openEditProductFromRow),
// so this GET route just redirects back. You can remove it if unused.
if (isset($_GET['update_product'])) {
    header("Location: ../template/adminside.php?tab=products");
    exit();
}
?>