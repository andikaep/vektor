<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Form Validation</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Forms</a></div>
        <div class="breadcrumb-item">Form Validation</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Form Validation</h2>
      <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <form class="needs-validation" novalidate="">
              <div class="card-header">
                <h4>JavaScript Validation</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Your Name</label>
                  <input type="text" class="form-control" required="">
                  <div class="invalid-feedback">
                    What's your name?
                  </div>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" required="">
                  <div class="invalid-feedback">
                    Oh no! Email is invalid.
                  </div>
                </div>
                <div class="form-group">
                  <label>Subject</label>
                  <input type="email" class="form-control">
                  <div class="valid-feedback">
                    Good job!
                  </div>
                </div>
                <div class="form-group mb-0">
                  <label>Message</label>
                  <textarea class="form-control" required=""></textarea>
                  <div class="invalid-feedback">
                    What do you wanna say?
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('templates/footer'); ?>