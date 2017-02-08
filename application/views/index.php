<?php
include('header.php');
$userid = $this->session->userdata('id');

$appointment_query = $this->db->query("SELECT COUNt(*) as total FROM appointment WHERE status != '9'");
$appointment_result = $appointment_query->result();

$service_query = $this->db->query("SELECT COUNt(*) as total FROM services WHERE status != '9'");
$service_result = $service_query->result();

$news_query = $this->db->query("SELECT COUNt(*) as total FROM setting WHERE type = '2' AND status != '9'");
$news_result = $news_query->result();

$promo_query = $this->db->query("SELECT COUNt(*) as total FROM setting WHERE type = '3' AND status != '9'");
$promo_result = $promo_query->result();
?>
<!--main content start-->
<section id="main-content">
  <section class="wrapper">

      <div class="row state-overview">
          <div class="col-lg-3 col-sm-6">
              <section class="panel">
                  <div class="symbol terques">
                      <i class="fa fa-user"></i>
                  </div>
                  <a href="<?php echo base_url() . 'index.php/customer/customer_list/'; ?>"><div class="value">
                          <h1 class="dashboard_color">
                              <?php echo $appointment_result[0]->total; ?>
                          </h1>
                          <p>Total Booking Appointments</p>
                      </div></a>
              </section>
          </div>
          <div class="col-lg-3 col-sm-6">
              <section class="panel">
                  <div class="symbol red">
                      <i class="fa fa-tags"></i>
                  </div>
                  <a href="<?php echo base_url() . 'index.php/sell/history/'; ?>">
                      <div class="value">
                          <h1 class="dashboard_color">
                              <?php echo $service_result[0]->total; ?>
                          </h1>
                          <p>Total Services</p>
                      </div>
                  </a>
              </section>
          </div>
          <div class="col-lg-3 col-sm-6">
              <section class="panel">
                  <div class="symbol yellow">
                      <i class="fa fa-shopping-cart"></i>
                  </div>
                  <a href="<?php echo base_url() . 'index.php/product/index/'; ?>">
                      <div class="value">
                          <h1 class="dashboard_color">
                              <?php echo $news_result[0]->total; ?>
                          </h1>
                          <p>Total News</p>
                      </div>
                  </a>
              </section>
          </div>
          <div class="col-lg-3 col-sm-6">
              <section class="panel">
                  <div class="symbol blue">
                      <i class="fa fa-bar-chart-o"></i>
                  </div>
                  <a href="<?php echo base_url() . 'index.php/sell/history/'; ?>">
                      <div class="value">
                          <h1 class="dashboard_color">
                              <?php echo $promo_result[0]->total; ?>
                          </h1>
                          <p>Total Promos</p>
                      </div>
                  </a>
              </section>
          </div>
      </div>
      <!--state overview end-->

  </section>
</section>
<!--main content end-->

<?php include('footer.php'); ?>