
            </div>
            <!-- </div> .="row" ABOVE -->
        </div>
        <!-- </div> #="contentdiv" ABOVE -->
    </section>
    <!-- </section> #="section-content" ABOVE -->

<!-- BootStrap 4 CDN JavaScript -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<!-- Custom JavaScript Script -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.product-img').hide();

        // add button listener
        $('.add-to-cart-form').on("submit", function() {
            // information in table / single product layout
            var id = $(this).find(".product-id").text();
            var quantity = $(this).find(".cart-quantity").val();
            // redirect to add_to_cart.php, with parameter values
            window.location.href = "add_to_cart.php?id=" + id + "&quantity=" + quantity;
            return false;
        });
        // update quantity button listener
        $('.update-quantity-form').on('submit', function() {
            // get basic information for updating the cart
            var id = $(this).find('.product-id').text();
            var quantity = $(this).find('.cart-quantity').val();
            // redirect to update_quantity.php 
            window.location.href = "update_quantity.php?id=" + id + "&quantity=" + quantity;
            return false;
        });
        // change product img on hoverenter
        //$(document).on('mouseover', '.product-img-thumbnail', function() {
        $('.product-img-thumbnail').mouseover(function() {
            var data_img_id = $(this).attr('data-img-id');
            $('.product-img').hide();
            $('#product-img-' + data_img_id).show();
        });
    });
</script>
</body>
</html>
