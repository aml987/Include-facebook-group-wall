<?php

/**
You can include any opened facebook group wall even you didn't a member of it, and you can include any closed facebook 
group, but you should be a member of it,
Please follow this three steps and run this code ...

1) Get an access token from https://developers.facebook.com/tools/explorer
2) Get the group ID from this site: lookup-id.com
3) Edit line 28 and 29 .

if you want a long lived Access Token please follow this steps:
1. On the top right, select the FB App you created from the "Application" drop down list
2. Click "Get Access Token"
3. Make sure you add the manage_pages permission
4. Convert this short-lived access token into a long-lived one by making this Graph API call: https://graph.facebook.com/oauth/access_token?client_id=1439315319643352&client_secret=9518c085cbfd4d59d9b201247854bdff&grant_type=fb_exchange_token&fb_exchange_token=<Shortlivedtoken>
5. Grab the new long-lived access token returned back
Grab the access_token for the page you'll be pulling info from



**/



header('Content-Type: text/html; charset=utf-8');

$access_token = 'replace by access token';
$group_id = 'replace by facebook group ID';

$limit = 10; // The number of posts fetched

$url1 = 'https://graph.facebook.com/'.$group_id.'?access_token='.$access_token;
$des = json_decode(file_get_contents($url1)) ;
 
 
 
/**echo '<pre>';
print_r($des);
echo '</pre>';**/
 
$url2 = "https://graph.facebook.com/{$group_id}/feed?access_token={$access_token}";
$data = json_decode(file_get_contents($url2));
?>
<style type="text/css">
.wrapperfb {
 width:100%;
 font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
 float:right;
 }
 
 .topfb {
 margin:5px;
 border-bottom:2px solid #e1e1e1;
 float: right;
 width:90%;
 }
 
 .singlefb {
 margin:3px;
 width:90%;
 border-bottom:1px dashed #e1e1e1;
 float: right;
 }
 
 .imgfb {
 float:right;
 width:60px;
 text-align:right;
 margin:5px 5px 5px 0px;
 border-right:1px dashed #e1e1e1;
 }
 
 .textfb {
 width:75%;
 float:right;
 font-size:12px;
 }
 
 .afb {
 text-decoration: none;
 color: #3b5998;
 }
</style>
 
<div class="wrapperfb">
  <div class="topfb">
 <a class="afb" href='http://www.facebook.com/home.php?sk=group_<?=$group_id?>&ap=1'>
<?=$des->name?></a>
<br>
<br>
 <?
 $counter = 0;
  
 foreach($data->data as $d) {
 if($counter==$limit)
 break;
 ?>
<div class="singlefb">
 <div class="imgfb">
 <a class="afb" href="http://facebook.com/profile.php?id=<?=$d->from->id?>">
    <img border="0" alt="<?=$d->from->name?>" src="https://graph.facebook.com/<?=$d->from->id?>/picture"/>
 </a>
 </div>
 <div class="textfb">
 <span style="font-weight:bold"><a class="afb" href="http://facebook.com/profile.php?id=<?=$d->from->id?>">
<?=$d->from->name?></a></span><br/>
 <span style="color: #999999;">on <?=date('F j, Y H:i',strtotime($d->created_time))?></span>
 <br/>

<?= nl2br( $d->message ) ?><br>

 <?=$d->name?><br>
 

 <a href="<?=$d->link?>"><img src="<?=$d->picture?>" title="<?=$d->description?>" width="50%" float="center"></a><br> 


<br>

 </div>
 </div>
 <?
 $counter++;
 }
 ?>
 <i>syCourse.com</i> &copy;
</div>
