<?php 
require_once 'Facebook/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' => '532707101580528',
    'app_secret' => '683eed1e6588dfd54592284a373e0c89',
    'default_graph_version' => 'v2.7',
]);
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
try {
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch (Facebook\Exceptions\facebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
if (isset($accessToken)) {
    if (isset($_SESSION['facebook_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    } else {
        // getting short-lived access token
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        // OAuth 2.0 client handler
        $oAuth2Client = $fb->getOAuth2Client();
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        // setting default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    //redirect the user to the profile page if it has "code" GET variable
    if (isset($_GET['code'])) {            
        header('Location: home.php');
    }
    //getting basic info about user
    try {
        $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
        $requestPicture = $fb->get('/me/picture?redirect=false&height=200'); //getting user picture
        $picture = $requestPicture->getGraphUser();
        $profile = $profile_request->getGraphUser();
        $fbid = $profile->getProperty('id');           // To Get Facebook ID
        $fbfullname = $profile->getProperty('name');   // To Get Facebook full name
        $fbemail = $profile->getProperty('email');    //  To Get Facebook email
        $fbpic = "<img src='" . $picture['url'] . "' class='img-rounded'/>";

        $_SESSION['fb_id'] = $fbid ;
        $_SESSION['fb_name'] = $fbfullname ;
        $_SESSION['fb_email'] = $fbemail ;
        $_SESSION['fb_pic'] = $fbpic ;

        $_SESSION['dangnhap_home'] = $fbfullname ;
        $_SESSION['khachhang_id'] = $fbid ; 
        $_SESSION['khachhang_email'] = $fbemail ;

        $user_id = $_SESSION['khachhang_id'];
        $user_email = $_SESSION['fb_email'];
        $user_name = $_SESSION['fb_name'];
        $sql_select_dangnhap = mysqli_query($con, "SELECT*FROM tbl_user_account WHERE  id = '$user_id' ");
        $row_user = mysqli_num_rows($sql_select_dangnhap);
        if($row_user <= 0){
            $sql_add_user = mysqli_query($con, "INSERT INTO tbl_user_account(id,fullname,email)
            values('$user_id','$user_name','$user_email')");
        }           
        # save the user nformation in session variable        
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // redirecting user back to app login page
        //header("Location: index.php");
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
} else {
    // replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used            
    $loginUrl = $helper->getLoginUrl('http://localhost/restaurant-master/page/login.php', $permissions);
}
?>