<div style="box-shadow: 0 0 1px 1px #0057c1;width:100%;">
<h3 style="color:#fff;background-color: #0057c1;padding: 15px;">New Message From :  {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
<p style="color: #0057c1;padding: 15px;min-height:180px;">{{ $message_mail }}</p>
<p style="color:#fff;background-color: #0057c1;padding: 15px;">
    Email : {{ Auth::user()->email }}<br>
    School Name : {{ Auth::user()->school_name }}<br>
    School District : {{ Auth::user()->school_district }}
</p>
Attched Image :
<?php if(empty($attched_name)){
    $alt = 'No Image';
}else{
    $alt = 'To See The Attached Image Click On Display Now Button';
}
if(empty($screen_shot)){
    $alt1 = 'No Image';
}else{
    $alt1 = 'To See The Attached Image Click On Display Now Button';
}
?>
<img src="<?php echo url('/'); ?>/contactus_image/{{ $attched_name }}" alt="{{ $alt }}">
<img src="<?php echo url('/'); ?>/contactus_image/{{ $screen_shot }}" alt="{{ $alt1 }}">
</div>
