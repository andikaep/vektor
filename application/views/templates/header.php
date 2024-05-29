<?php
defined('BASEPATH') or exit('No direct script access allowed');
$website = $this->db->get('admin_website')->row_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $title; ?> &mdash; <?= $website['nama_website']; ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables/buttons.bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>sources/scss/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>sources/scss/components.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jquery-selectric/selectric.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/dropzonejs/dropzone.css">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>