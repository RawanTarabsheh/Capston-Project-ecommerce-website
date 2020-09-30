<?php  ob_start();
   require_once('include/header.php');
   require_once('admin/production/include/database.php');
   require_once('admin/production/include/contact_us.php');

         // get database connection
$database     = new Database();
$db           = $database->getConnection();
$contact      = new Contact_us($db);
if(isset($_POST['send']))
{
    $contact->name     = $_POST['name'];
    $contact->email    = $_POST['email'];
    $contact->message  = $_POST['message'];
    $contact->date     = date("Y-m-d");

   if( $contact->create())
    $message   = "The message has been sent successfully";
   else
    $message= "An error occurred, try again";

}
?>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Contact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__content">
                        <div class="contact__address">
                            <h5>Contact info</h5>
                            <ul>
                                <li>
                                    <h6><i class="fa fa-map-marker"></i> Address</h6>
                                    <p>Jordan, Amman, Sweileh .King Abdullah St.</p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-phone"></i> Phone</h6>
                                    <p><span>125-711-811</span><span>125-668-886</span></p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-headphones"></i> Support</h6>
                                    <p>Support@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="contact__form">
                            <h5>SEND MESSAGE</h5>
                            <?php
                            if(isset($message))
                            {
                            echo '<div class="alert alert-success">'.$message.'</div>';
                            }
                            ?>
                            <form action="" method="post">
                                <input type="text" placeholder="Name" name="name" required>
                                <input type="email" placeholder="Email" name="email" required>
                                <textarea placeholder="Message" name="message"></textarea>
                                <button type="submit" class="site-btn" name="send">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__map">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27063.387225329418!2d35.82222043518936!3d32.0171884815075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151c9f55c7bda3e9%3A0x9206ec9264a5ba9a!2sSweileh%2C%20Amman!5e0!3m2!1sen!2sjo!4v1600119890855!5m2!1sen!2sjo" width="600" height="780" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                   
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<?php 
require_once('include/footer.php');
?>