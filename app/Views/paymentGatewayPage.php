<?php
$pendingBooking = $_SESSION['PendingBooking'];
?>

<form method="POST" action="https://sandbox.payhere.lk/pay/checkout"> <!-- use live URL later -->
    <input type="hidden" name="merchant_id" value="1230180"> <!-- Replace it -->
    <input type="hidden" name="return_url" value="http://localhost/ExploreEase/hotel/paymentSuccess">
    <input type="hidden" name="cancel_url" value="http://localhost/ExploreEase/hotel/paymentCancel">
    <input type="hidden" name="notify_url" value="http://localhost/ExploreEase/hotel/paymentNotify">
    <br><input type="hidden" name="order_id" value="<?php echo $pendingBooking['OrderID']; ?>">
    <input type="hidden" name="items" value="Hotel Room Booking">
    <input type="hidden" name="currency" value="LKR">
    <input type="hidden" name="amount" value="<?php echo $pendingBooking['TotalPrice']; ?>">

    <!-- Traveler details -->
    <input type="hidden" name="first_name" value="Traveler">
    <input type="hidden" name="last_name" value="Traveler">
    <input type="hidden" name="email" value="traveler@email.com">
    <input type="hidden" name="phone" value="0771234567">
    <input type="hidden" name="address" value="Colombo">
    <input type="hidden" name="city" value="Colombo">
    <input type="hidden" name="country" value="Sri Lanka">

    <button type="submit">Proceed to Payment</button>
</form>