<?php
                                    require_once '../vendor/autoload.php';
                                    // init configuration
                                    $clientID = '580931494794-tpi4lqq3cu2b6mc715mif96pb60kpjoo.apps.googleusercontent.com';
                                    $clientSecret = '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';
                                    $redirectUri = 'http://localhost/restaurant-master/page/home.php';
                                    // create Client Request to access Google API
                                    $client = new Google_Client();
                                    $client->setClientId($clientID);
                                    $client->setClientSecret($clientSecret);
                                    $client->setRedirectUri($redirectUri);
                                    $client->addScope("email");
                                    $client->addScope("profile");

                                    // authenticate code from Google OAuth Flow
                                    if (isset($_GET['code'])) {
                                    
                                    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);                                                                       
                                    $client->setAccessToken($token['access_token']);                                                                                                          
                                    // get profile info
                                    $google_oauth = new Google_Service_Oauth2($client);
                                    $google_account_info = $google_oauth->userinfo->get();
                                    $userinfo = [
                                        'gg_email'=> $google_account_info['email'],
                                        'gg_fullname' => $google_account_info['name'],
                                        'gg_verifiedEmail' => $google_account_info['verifiedEmail'],
                                        'gg_token' => $google_account_info['id'],
                                    ];
                                    $_SESSION['dangnhap_home'] = $google_account_info->name;
                                    $_SESSION['khachhang_id'] = $google_account_info->id;
                                    $_SESSION['khachhang_email'] = $google_account_info->email;

                                    
                                    $user_id1 =  $_SESSION['khachhang_id'];    
                                                                
                                    $user_email1 =   $_SESSION['khachhang_email'];
                                    $user_name1 = $_SESSION['dangnhap_home'];
                                    $sql_select_dangnhap1 = mysqli_query($con, "SELECT*FROM tbl_user_account WHERE id ='$user_id1' ");
                                    $row_user1 = mysqli_num_rows($sql_select_dangnhap1);
                                    
                                    if($row_user1 <= 0){
                                        $sql_add_user = mysqli_query($con, "INSERT INTO tbl_user_account(id,fullname,email)
                                        values('$user_id1','$user_name1','$user_email1')");
                                    }     
                                                                                                                             
                                    // now you can use this profile info to create account in your website and make user logged in.
                                    }
                                    
?>