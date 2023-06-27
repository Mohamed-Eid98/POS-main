<footer class="site-footer">
    <div class="container">
        <div class="row m-auto">
            <div class="col-sm-12 col-md-6">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <img src="{{asset('assets/img/Removal-722.png')}}" class="img-fluid">
                    </div>

                    <div class="col-sm-12 col-md-1"></div>

                    <div class="col-sm-12 col-md-5">
                        <h6>Information</h6>

                        <p><span><i class="fa-solid fa-envelope mt-4"></i></span>contact@company.com</p></span>
                        <p><span><i class="fa-solid fa-phone"></i></span> +2 123456789</p>
                        <p><i class="fa-brands fa-facebook-f me-3"></i> <i
                                class="fa-brands fa-twitter me-3"></i>
                            <i class="fa-brands fa-instagram me-3"></i><i
                                class="fa-brands fa-linkedin-in me-3"></i>
                            <i class="fa-brands fa-pinterest-p"></i>

                    </div>

                </div>
            </div>

            <div class="col-xs-6 col-md-2">
                <h6>Categories</h6>
                <ul class="footer-links">
                    <li><a href="man">Men</a></li>
                    <li><a href="women">Women</a></li>
                    <li><a href="accessories">Accessories</a></li>
                    <li><a href="shoes">Shoes</a></li>
                    <li><a href="Denim">Denim</a></li>
                    <li><a href="dress.htl">Dress</a></li>
                </ul>
            </div>

            <div class="col-xs-6 col-md-2">
                <h6>Quick Links</h6>
                <ul class="footer-links">
                    <li><a href="contact">Contact Us</a></li>
                    <li><a href="personal">My account</a></li>
                    <li><a href="cart">My cart</a></li>
                </ul>
            </div>
        </div>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <p class="copyright-text">
                 © 2023 Modern Academy. All rights reserved.
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="social-icons">
                    <li><a class="facebook" href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a class="dribbble" href="#"><i class="fa-brands fa-dribbble"></i></a></li>
                    <li><a class="linkedin" href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>


<script>
    let mybutton = document.getElementById("myBtn");
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>


<script src="{{ asset('assets/js/all.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>


</body>

</html>
