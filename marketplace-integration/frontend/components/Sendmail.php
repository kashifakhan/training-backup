<?php 

namespace frontend\components;
use yii\base\Component;

class Sendmail extends Component
{
	public static function installmail($email)
	{
		$mer_email=$email;
		
		$subject = "Thank you for Installing shopify Jet-Integration app";
		
		$headers_mer = "MIME-Version: 1.0" . chr(10);
		$headers_mer .= "Content-type:text/html;charset=iso-8859-1" . chr(10);
		$headers_mer .= 'From: shopify@cedcommerce.com' . chr(10);
		$headers_mer .= 'Bcc: kshitijverma@cedcoss.com' . chr(10);
		$headers_mer .= 'Bcc: abhishekjaiswal@cedcoss.com' . chr(10);
		$headers_mer .= 'Bcc: karshitbhargava@cedcoss.com' . chr(10);
		
		
		$etx_mer .='
					<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					   <head>
					      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
					      <title>Order acknowledgedment Mail</title>
					      
					      <style type="text/css">
					         /* Client-specific Styles */
					         div, p, a, li, td { -webkit-text-size-adjust:none; }
					         #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
					         html{width: 100%; }
					         body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
					         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
					         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
					         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing. */
					         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
					         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
					         a img {border:none;}
					         .image_fix {display:block;}
					         p {margin: 0px 0px !important;}
					         table td {border-collapse: collapse;}
					         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
					         a {color: #33b9ff;text-decoration: none;text-decoration:none!important;}
					         /*STYLES*/
					         table[class=full] { width: 100%; clear: both; }
					         /*IPAD STYLES*/
					         @media only screen and (max-width: 640px) {
					         a[href^="tel"], a[href^="sms"] {
					         text-decoration: none;
					         color: #33b9ff; /* or whatever your want */
					         pointer-events: none;
					         cursor: default;
					         }
					         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
					         text-decoration: default;
					         color: #33b9ff !important;
					         pointer-events: auto;
					         cursor: default;
					         }
					         table[class=devicewidth] {width: 440px!important;text-align:center!important;}
					         table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
					         img[class=banner] {width: 440px!important;height:220px!important;}
					         img[class=col2img] {width: 440px!important;height:220px!important;}
					         
					         
					         }
					         /*IPHONE STYLES*/
					         @media only screen and (max-width: 480px) {
					         a[href^="tel"], a[href^="sms"] {
					         text-decoration: none;
					         color: #33b9ff; /* or whatever your want */
					         pointer-events: none;
					         cursor: default;
					         }
					         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
					         text-decoration: default;
					         color: #33b9ff !important; 
					         pointer-events: auto;
					         cursor: default;
					         }
					         table[class=devicewidth] {width: 280px!important;text-align:center!important;}
					         table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
					         img[class=banner] {width: 280px!important;height:140px!important;}
					         img[class=col2img] {width: 280px!important;height:140px!important;}
					         
					        
					         }
					         
					      </style>
					   </head>
					   <body>
					
					<!-- Start of preheader -->
					<table id="backgroundTable" border="0" cellpadding="0" cellspacing="0" align="center" width="100%" bg-color="#f2f2f2" style="background-color:#f2f2f2;">
					   <tr>
					      <td>
					         <table width="600px" align="center" bgcolor="#fcfcfc" border="0" cellpadding="0" cellspacing="0">
					            <tr>
					               <td>
					                  <table  st-sortable="preheader" bgcolor="#fcfcfc" border="0" cellpadding="0" cellspacing="0" width="600px" align="center">
					                     <tbody>
					                        <tr>
					                           <td>
					                              <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					                                 <tbody>
					                                    <tr>
					                                       <td width="100%">
					                                          <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					                                             <tbody>
					                                                <!-- Spacing -->
					                                                <tr>
					                                                   <td height="20" width="100%" bgcolor="#ffffff"></td>
					                                                </tr>
					                                                <!-- Spacing -->
					                                                <tr>
					                                                   <td style="font-family: Helvetica, arial, sans-serif; font-size: 17px;color: #282828; font-weight:bold;" st-content="preheader" align="left" valign="middle" width="50%" bgcolor="#ffffff">
					                                                      '.$email.'
					                                                   </td>
					                                                   <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #282828" st-content="preheader" align="right" valign="middle" width="50%" bgcolor="#ffffff">
					                                                      <a href="http://cedcommerce.com/" target="_blank"><img src="https://shopify.cedcommerce.com/jet/images/logo-mail.jpg" width="165px"></a>
					                                                   </td>
					                                                </tr>
					                                                <!-- Spacing -->
					                                                <tr>
					                                                   <td height="20" width="100%" bgcolor="#ffffff"></td>
					                                                </tr>
					                                                <!-- Spacing -->
					                                             </tbody>
					                                          </table>
					                                       </td>
					                                    </tr>
					                                 </tbody>
					                              </table>
					                           </td>
					                        </tr>
					                     </tbody>
					                  </table>
					
					         <table  st-sortable="banner"  border="0" cellpadding="0" cellspacing="0" width="600px" align="center">
					            <tbody>
					               <tr>
					                  <td>
					                     <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					                        <tbody>
					                           <tr>
					                              <td width="100%">
					                                 <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					                                    <tbody>
					                                       <tr>
					                                          <!-- start of image -->
					                                          <td st-image="banner-image" align="center">
					                                             <div class="imgpop">
					                                                
					                                             </div>
					                                             
					                                          </td>
					                                       </tr>
					                                    </tbody>
					                                 </table>
					                                 <!-- end of image -->
					                              </td>
					                           </tr>
					                        </tbody>
					                     </table>
					                  </td>
					               </tr>
					            </tbody>
					         </table>
					
					         <table  st-sortable="full-text" bgcolor="#fcfcfc" border="0" cellpadding="0" cellspacing="0" width="600px" align="center">
					            <tbody>
					               <tr>
					                  <td style="padding-left:15px;padding-right:15px;">
					                     <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					                        <tbody>
					                           <tr>
					                              <td width="100%">
					                                 <table class="devicewidth" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="600">
					                                    <tbody>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="20">&nbsp;</td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td bgcolor="#ffffff">
					                                             <table class="devicewidthinner" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					                                                <tbody>
					                                                   <!-- Title -->
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #018001; text-align:center; line-height: 24px; font-weight:bold;">
					                                                        Congratulations!!! you have successfully installed CedCommerce Shopify JET Integration App.
					                                                      </td>
					                                                   </tr>
					                                                   <!-- End of Title -->
					                                                   <!-- spacing -->
					                                                   <tr>
					                                                      <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="15" width="100%">&nbsp;</td>
					                                                   </tr>
					                                                   <!-- End of spacing -->
					                                                   <!-- content -->
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;">
					                                                         <b>To activate the Jet API Keys , please follow the steps given below ... </b>
					                                                      </td>
					                                                   </tr>
					                                                   <!-- End of content -->
					                                                   <!-- order details  -->
					                                                   <tr>
					                                                      <td align="center" style="padding-top:15px;">
					                                                         <table align="center" width="100%" border="1" style="border-color:#707070;">
					                                                            <tr>
					                                                               <td align="center" style="color: #707070;font-family: arial;font-weight: bold;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;">
					                                                                  Welcome Screen
					                                                               </td>
					                                                      		   <td style="color: #7d7d7d;font-family: arial;font-size: 14px;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;text-align: center;">
					                                                      				<p>[<a href="https://www.dropbox.com/s/25idzvtkh3alga7/10180349.png?dl=0" target="_blank"> Help Screenshot</a>]</p>
					                                                      		   </td>
					                                                      		</tr>
					                                                      		<tr>
					                                                               <td align="center" style="color: #707070;font-family: arial;font-weight: bold;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;">
					                                                                  Step 1 : Get test api Keys
					                                                               </td>
					                                                      		   <td style="color: #7d7d7d;font-family: arial;font-size: 14px;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;text-align: center;">
					                                                      				<p>[<a href="https://partner.jet.com/testapi" target="_blank">Click to get Test API Keys</a>] | [<a href="https://www.dropbox.com/s/po3zg5c9e66v9yk/9918920.png?dl=0" target="_blank">Screenshot</a>]</p>
					                                                      		   </td>
					                                                      		</tr>
					                                                      		<tr>
					                                                               <td align="center" style="color: #707070;font-family: arial;font-weight: bold;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;">
					                                                                  Step 2 : Get fulfillment Node ID
					                                                               </td>
					                                                      		   <td style="color: #7d7d7d;font-family: arial;font-size: 14px;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;text-align: center;">
					                                                      				<p>[<a href="https://partner.jet.com/fulfillmentnode" target="_blank">Click to get fulfillment Node ID</a>] | [<a href="https://www.dropbox.com/s/tfcy7rn1p5y7zix/9918922.png?dl=0" target="_blank">Screenshot</a>]</p>
					                                                      		   </td>
					                                                      		</tr>
					                                                      		<tr>
					                                                               <td align="center" style="color: #707070;font-family: arial;font-weight: bold;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;">
					                                                                  Step 3 : Get live api Keys
					                                                               </td>
					                                                      		   <td style="color: #7d7d7d;font-family: arial;font-size: 14px;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;text-align: center;">
					                                                      				<p>[<a href="https://partner.jet.com/dashboard" target="_blank">Click to get Live API Keys</a>] | [<a href="https://www.dropbox.com/s/7v3y9rsqu4fik5t/9918923.png?dl=0" target="_blank">Screenshot</a>]</p>
					                                                      			</td>
					                                                            </tr>
					                                                         </table>
					                                                      </td>
					                                                   </tr>
					                                                   <!-- end of order details -->
					                                                   <!-- Spacing -->
					                                                   <tr>
					                                                      <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="15" width="100%">&nbsp;</td>
					                                                   </tr>
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;font-weight:bold;">
					                                                         Please See the shared video for Configuration setup and Product type Mapping with Jet Category
					                                                      </td>
					                                                   </tr>
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #333333; text-align:center; line-height: 24px; ">
					                                                         <a href="https://www.youtube.com/watch?v=px90kC3oCbE" target="_blank">https://www.youtube.com/watch?v=px90kC3oCbE</a>
					                                                      </td>
					                                                   </tr>
					                                                   <!-- spacing -->
					                                                   <tr>
					                                                      <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="15" width="100%">&nbsp;</td>
					                                                   </tr>
					                                                   <!-- End of spacing -->
					                                                    <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;font-weight:bold;">
					                                                         Please go through the jet shopify documentation(How to sell on jet)
					                                                      </td>
					                                                   </tr>
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #333333; text-align:center; line-height: 24px; ">
					                                                         <a href="https://shopify.cedcommerce.com/jet/how-to-sell-on-jet-com" target="_blank">https://shopify.cedcommerce.com/jet/how-to-sell-on-jet-com</a>
					                                                      </td>
					                                                   </tr>
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;font-weight:bold;">
					                                                         If you are still unable to set the jet configuration details , then please communicate with our team, they will provide you full support (FREE) in jet configuration setup.
					                                                      </td>
					                                                   </tr>
					                                                   <!-- spacing -->
					                                                   <tr>
					                                                      <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="15" width="100%">&nbsp;</td>
					                                                   </tr>
					                                                   <!-- End of spacing -->  
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;font-weight:bold;">
					                                                         Please use the below link to purchase Jet-Integration app fron your shopify store
					                                                      </td>
					                                                   </tr>
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #333333; text-align:center; line-height: 24px; ">
					                                                         <a href="https://shopify.cedcommerce.com/jet/site/paymentplan" target="_blank">https://shopify.cedcommerce.com/jet/site/paymentplan</a>
					                                                      </td>
					                                                   </tr>
					                                                   <!-- spacing -->
					                                                   <tr>
					                                                      <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="15" width="100%">&nbsp;</td>
					                                                   </tr>
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #976F9E; text-align:center; line-height: 24px; font-weight:bold;">
					                                                         For any Query / Help / Suggestion, Please contact us via
					                                                      </td>
					                                                   </tr>
					                                                   <tr>
					                                                      <td align="center" style="padding-top:15px;padding-bottom:15px;">
					                                                         <table align="center" width="100%" border="1" style="border-color:#707070;">
					                                                            <tr>
					                                                               <td align="center" style="color: #707070;font-family: arial;font-weight: bold;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;">
					                                                                  <img src="https://shopify.cedcommerce.com/jet/images/ZopimChat.png" width="50px">
					                                                               </td>
					                                                               <td align="center" style="color: #707070;font-family: arial;font-weight: bold;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;">
					                                                                  <img src="https://shopify.cedcommerce.com/jet/images/Ticket.png" width="50px">
					                                                               </td>
					                                                               <td align="center" style="color: #707070;font-family: arial;font-weight: bold;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;">
					                                                                   <img src="https://shopify.cedcommerce.com/jet/images/Skype.png" width="50px">
					                                                            </tr>
					                                                            <tr>
					                                                               <td style="color: #7d7d7d;font-family: arial;font-size: 14px;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;text-align: center; line-height:25px;width:33%;">
					                                                                  Zopm Chat
					                                                               </td>
					                                                               <td style="color: #7d7d7d;font-family: arial;font-size: 14px;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;text-align: center;line-height:25px;width:33%;">
					                                                                  Ticket</br> (<a href="http://support.cedcommerce.com/" style="color:#976F9E; text-decoration:none; font-size:15px; font-family:arial;">support.cedcommerce.com</a>)
					                                                               </td>
					                                                               <td style="color: #7d7d7d;font-family: arial;font-size: 14px;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;text-align: center;line-height:25px;width:33%;">
					                                                                  Skype</br> (Skype id : cedcommerce)
					                                                               </td>
					                                                            </tr>
					                                                         </table>
					                                                      </td>
					                                                   </tr>
					                                                   <!-- Spacing -->
					                                                </tbody>
					                                             </table>
					                                          </td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="20">&nbsp;</td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                    </tbody>
					                                 </table>
					                              </td>
					                           </tr>
					                        </tbody>
					                     </table>
					                  </td>
					               </tr>
					            </tbody>
					         </table>
					         <!-- End of Full Text -->
					
					         <!-- Start of Right Image -->      
					         <table id="" st-sortable="right-image" bgcolor="#fcfcfc" border="0" cellpadding="0" cellspacing="0" width="600px" align="center">
					            <tbody>
					               <tr>
					                  <td>
					                     <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="600" >
					                        <tbody>
					                           <tr>
					                              <td width="100%">
					                                 
					                              </td>
					                           </tr>
					                        </tbody>
					                     </table>
					                  </td>
					               </tr>
					            </tbody>
					         </table>
					         <!-- End of Right Image -->
					
					         <!-- Start of footer -->
					         <table  st-sortable="footer" bgcolor="" border="0" cellpadding="0" cellspacing="0" width="600px" align="center">
					            <tbody>
					               <tr>
					                  <td>
					                     <table class="devicewidth" align="center" bgcolor="" border="0" cellpadding="0" cellspacing="0" width="600">
					                        <tbody>
					                           <tr>
					                              <td width="100%">
					                                 <table class="devicewidth" align="center" bgcolor="" border="0" cellpadding="0" cellspacing="0" width="600">
					                                    <tbody>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="10">&nbsp;</td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;">
					                                             Thanks and Best Reagards
					                                           </td>
					                                       </tr>
					                                       <tr>
					                                          <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;">
					                                             Cedcommerce Shopify Team
					                                           </td>
					                                       </tr>
					                                       <tr>
					                                          <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;">
					                                             <b>Email : </b> <a href="http://support.cedcommerce.com/">support.cedcommerce.com</a>   |   <b>Web :</b> <a href="http://cedcommerce.com/">cedcommerce.com</a> 
					                                           </td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="20">&nbsp;</td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td>
					                                             <!-- Social icons -->
					                                             <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="150">
					                                                <tbody>
					                                                   <tr>
					                                                      <td align="center" height="43" width="43">
					                                                         <div class="imgpop">
					                                                            <a href="https://www.facebook.com/CedCommerce/"><img alt="" src="https://shopify.cedcommerce.com/jet/images/Polygon-fb.png"></a>
					                                                         </div>
					                                                      </td>
					                                                      <td style="font-size:1px; line-height:1px;" align="left" width="20">&nbsp;</td>
					                                                      <td align="center" height="43" width="43">
					                                                         <div class="imgpop">
					                                                            <a href="https://plus.google.com/u/0/118378364994508690262"><img alt="" src="https://shopify.cedcommerce.com/jet/images/Polygon-google.png"></a>
					                                                         </div>
					                                                      </td>
					                                                      <td style="font-size:1px; line-height:1px;" align="left" width="20">&nbsp;</td>
					                                                      <td align="center" height="43" width="43">
					                                                         <div class="imgpop">
					                                                            <a href="https://www.linkedin.com/company/cedcommerce"><img alt="" src="https://shopify.cedcommerce.com/jet/images/Polygon-linkedin.png"></a>
					                                                         </div>
					                                                      </td>
					                                                      <td align="center" height="43" width="43">
					                                                         <div class="imgpop">
					                                                            <a href="https://twitter.com/cedcommerce"><img alt="" src="https://shopify.cedcommerce.com/jet/images/polygon-tweet_1.png"></a>
					                                                         </div>
					                                                      </td>
					                                                   </tr>
					                                                </tbody>
					                                             </table>
					                                             <!-- end of Social icons -->
					                                          </td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="25">&nbsp;</td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                    </tbody>
					                                 </table>
					                              </td>
					                           </tr>
					                        </tbody>
					                     </table>
					                  </td>
					               </tr>
					            </tbody>
					         </table>
					         <!-- End of footer -->
					               </td>
					            </tr>
					         </table>
					      </td>
					   </tr>
					</table>  
					   
					 </body>
					   </html>'.chr(10);
		
		
		mail($mer_email,$subject, $etx_mer, $headers_mer);
	} 
	
	// Send mail If merchant un-installs the Jet-Integration app
	public static function uninstallmail($email)
	{
		$mer_email=$email;
	
		$subject = "It's Sad To See You Leave ";
	
		$headers_mer = "MIME-Version: 1.0" . chr(10);
		$headers_mer .= "Content-type:text/html;charset=iso-8859-1" . chr(10);
		$headers_mer .= 'From: shopify@cedcommerce.com' . chr(10);
		$headers_mer .= 'Bcc: kshitijverma@cedcoss.com' . chr(10);
		$headers_mer .= 'Bcc: karshitbhargava@cedcoss.com' . chr(10);
			
		$etx_mer .='
					<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					   <head>
					      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
					      <title>Order acknowledgedment Mail</title>
					 
					      <style type="text/css">
					         /* Client-specific Styles */
					         div, p, a, li, td { -webkit-text-size-adjust:none; }
					         #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
					         html{width: 100%; }
					         body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
					         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
					         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
					         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing. */
					         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
					         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
					         a img {border:none;}
					         .image_fix {display:block;}
					         p {margin: 0px 0px !important;}
					         table td {border-collapse: collapse;}
					         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
					         a {color: #33b9ff;text-decoration: none;text-decoration:none!important;}
					         /*STYLES*/
					         table[class=full] { width: 100%; clear: both; }
					         /*IPAD STYLES*/
					         @media only screen and (max-width: 640px) {
					         a[href^="tel"], a[href^="sms"] {
					         text-decoration: none;
					         color: #33b9ff; /* or whatever your want */
					         pointer-events: none;
					         cursor: default;
					         }
					         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
					         text-decoration: default;
					         color: #33b9ff !important;
					         pointer-events: auto;
					         cursor: default;
					         }
					         table[class=devicewidth] {width: 440px!important;text-align:center!important;}
					         table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
					         img[class=banner] {width: 440px!important;height:220px!important;}
					         img[class=col2img] {width: 440px!important;height:220px!important;}
	
	
					         }
					         /*IPHONE STYLES*/
					         @media only screen and (max-width: 480px) {
					         a[href^="tel"], a[href^="sms"] {
					         text-decoration: none;
					         color: #33b9ff; /* or whatever your want */
					         pointer-events: none;
					         cursor: default;
					         }
					         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
					         text-decoration: default;
					         color: #33b9ff !important;
					         pointer-events: auto;
					         cursor: default;
					         }
					         table[class=devicewidth] {width: 280px!important;text-align:center!important;}
					         table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
					         img[class=banner] {width: 280px!important;height:140px!important;}
					         img[class=col2img] {width: 280px!important;height:140px!important;}
	
					  
					         }
	
					      </style>
					   </head>
					   <body>
			
					<!-- Start of preheader -->
					<table id="backgroundTable" border="0" cellpadding="0" cellspacing="0" align="center" width="100%" bg-color="#f2f2f2" style="background-color:#f2f2f2;">
					   <tr>
					      <td>
					         <table width="600px" align="center" bgcolor="#fcfcfc" border="0" cellpadding="0" cellspacing="0">
					            <tr>
					               <td>
					                  <table  st-sortable="preheader" bgcolor="#fcfcfc" border="0" cellpadding="0" cellspacing="0" width="600px" align="center">
					                     <tbody>
					                        <tr>
					                           <td>
					                              <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					                                 <tbody>
					                                    <tr>
					                                       <td width="100%">
					                                          <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					                                             <tbody>
					                                                <!-- Spacing -->
					                                                <tr>
					                                                   <td height="20" width="100%" bgcolor="#ffffff"></td>
					                                                </tr>
					                                                <!-- Spacing -->
					                                                <tr>
					                                                   <td style="font-family: Helvetica, arial, sans-serif; font-size: 17px;color: #282828; font-weight:bold;" st-content="preheader" align="left" valign="middle" width="50%" bgcolor="#ffffff">
					                                                      '.$email.'
					                                                   </td>
					                                                   <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #282828" st-content="preheader" align="right" valign="middle" width="50%" bgcolor="#ffffff">
					                                                      <a href="http://cedcommerce.com/" target="_blank"><img src="https://shopify.cedcommerce.com/jet/images/logo-mail.jpg" width="165px"></a>
					                                                   </td>
					                                                </tr>
					                                                <!-- Spacing -->
					                                                <tr>
					                                                   <td height="20" width="100%" bgcolor="#ffffff"></td>
					                                                </tr>
					                                                <!-- Spacing -->
					                                             </tbody>
					                                          </table>
					                                       </td>
					                                    </tr>
					                                 </tbody>
					                              </table>
					                           </td>
					                        </tr>
					                     </tbody>
					                  </table>
			
					        <table  st-sortable="full-text" bgcolor="#fcfcfc" border="0" cellpadding="0" cellspacing="0" width="600px" align="center">
					            <tbody>
					               <tr>
					                  <td style="padding-left:15px;padding-right:15px;">
					                     <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					                        <tbody>
					                           <tr>
					                              <td width="100%">
					                                 <table class="devicewidth" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="600">
					                                    <tbody>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="20">&nbsp;</td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td bgcolor="#ffffff">
					                                             <table class="devicewidthinner" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
					                                                <tbody>
					                                                   <!-- Title -->
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #018001; text-align:center; line-height: 24px; font-weight:bold;">
					                                                        We are very sad to see you uninstalled shopify <a href="https://apps.shopify.com/jet-integration" target="_blank">Jet-Integration</a> app after spending some time trying. 
					                                                      </td>
					                                                   </tr>
					                                                   <!-- End of Title -->
					                                                   <!-- spacing -->
					                                                   <tr>
					                                                      <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="15" width="100%">&nbsp;</td>
					                                                   </tr>
					                                                   <tr>
					                                                      <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="15" width="100%">&nbsp;</td>
					                                                   </tr>
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:justify; line-height: 24px;font-weight:bold;">
					                                                         We are working hard everyday to improve our app and service for you. Could you please let us know why you did not want to use Jet-Integration app, or what can we do to provide you better help? 
					                                                      </td>
					                                                   </tr>
					                                                   <!-- End of spacing -->
					                                                    
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:justify; line-height: 24px;font-weight:bold;">
					                                                         We hope you will give another chance to <a href="https://apps.shopify.com/jet-integration" target="_blank">Jet-Integration</a> app and see results from it.
					                                                      </td>
					                                                   </tr>
					                                                   <!-- spacing -->
					                                                   <tr>
					                                                      <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="15" width="100%">&nbsp;</td>
					                                                   </tr>
					                                                   <!-- End of spacing -->
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:justify; line-height: 24px;font-weight:bold;">
					                                                        We look forward to hear from you. Your feedback means a lot to cedcommerce shopify team.
					                                                      </td>
					                                                   </tr>
					                                                   <!-- spacing -->
					                                                   <tr>
					                                                      <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="15" width="100%">&nbsp;</td>
					                                                   </tr>
					                                                   <tr>
					                                                      <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #976F9E; text-align:center; line-height: 24px; font-weight:bold;">
					                                                         For any Query / Help / Suggestion, Please contact us via
					                                                      </td>
					                                                   </tr>
					                                                   <tr>
					                                                      <td align="center" style="padding-top:15px;padding-bottom:15px;">
					                                                         <table align="center" width="100%" border="1" style="border-color:#707070;">
					                                                            <tr>
					                                                               <td align="center" style="color: #707070;font-family: arial;font-weight: bold;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;">
					                                                                  <img src="https://shopify.cedcommerce.com/jet/images/ZopimChat.png" width="50px">
					                                                               </td>
					                                                               <td align="center" style="color: #707070;font-family: arial;font-weight: bold;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;">
					                                                                  <img src="https://shopify.cedcommerce.com/jet/images/Ticket.png" width="50px">
					                                                               </td>
					                                                               <td align="center" style="color: #707070;font-family: arial;font-weight: bold;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;">
					                                                                   <img src="https://shopify.cedcommerce.com/jet/images/Skype.png" width="50px">
					                                                            </tr>
					                                                            <tr>
					                                                               <td style="color: #7d7d7d;font-family: arial;font-size: 14px;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;text-align: center; line-height:25px;width:33%;">
					                                                                  Zopm Chat
					                                                               </td>
					                                                               <td style="color: #7d7d7d;font-family: arial;font-size: 14px;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;text-align: center;line-height:25px;width:33%;">
					                                                                  Ticket</br> (<a href="http://support.cedcommerce.com/" style="color:#976F9E; text-decoration:none; font-size:15px; font-family:arial;">support.cedcommerce.com</a>)
					                                                               </td>
					                                                               <td style="color: #7d7d7d;font-family: arial;font-size: 14px;padding-left:3px;padding-right:3px;padding-top:7px;padding-bottom:7px;text-align: center;line-height:25px;width:33%;">
					                                                                  Skype</br> (Skype id : cedcommerce)
					                                                               </td>
					                                                            </tr>
					                                                         </table>
					                                                      </td>
					                                                   </tr>
					                                                   <!-- Spacing -->
					                                                </tbody>
					                                             </table>
					                                          </td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="20">&nbsp;</td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                    </tbody>
					                                 </table>
					                              </td>
					                           </tr>
					                        </tbody>
					                     </table>
					                  </td>
					               </tr>
					            </tbody>
					         </table>
					         <!-- End of Full Text -->
			
					         <!-- Start of Right Image -->
					         <table id="" st-sortable="right-image" bgcolor="#fcfcfc" border="0" cellpadding="0" cellspacing="0" width="600px" align="center">
					            <tbody>
					               <tr>
					                  <td>
					                     <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="600" >
					                        <tbody>
					                           <tr>
					                              <td width="100%">
	
					                              </td>
					                           </tr>
					                        </tbody>
					                     </table>
					                  </td>
					               </tr>
					            </tbody>
					         </table>
					         <!-- End of Right Image -->
			
					         <!-- Start of footer -->
					         <table  st-sortable="footer" bgcolor="" border="0" cellpadding="0" cellspacing="0" width="600px" align="center">
					            <tbody>
					               <tr>
					                  <td>
					                     <table class="devicewidth" align="center" bgcolor="" border="0" cellpadding="0" cellspacing="0" width="600">
					                        <tbody>
					                           <tr>
					                              <td width="100%">
					                                 <table class="devicewidth" align="center" bgcolor="" border="0" cellpadding="0" cellspacing="0" width="600">
					                                    <tbody>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="10">&nbsp;</td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;">
					                                             Thanks and Best Reagards
					                                           </td>
					                                       </tr>
					                                       <tr>
					                                          <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;">
					                                             Cedcommerce Support Team
					                                           </td>
					                                       </tr>
					                                       <tr>
					                                          <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;">
					                                             <b>E-mail : </b> <a href="http://support.cedcommerce.com/">support.cedcommerce.com</a>   |   <b>Web :</b> <a href="http://cedcommerce.com/">cedcommerce.com</a>
					                                           </td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="20">&nbsp;</td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td>
					                                             <!-- Social icons -->
					                                             <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0" width="150">
					                                                <tbody>
					                                                   <tr>
					                                                      <td align="center" height="43" width="43">
					                                                         <div class="imgpop">
					                                                            <a href="https://www.facebook.com/CedCommerce/"><img alt="" src="https://shopify.cedcommerce.com/jet/images/Polygon-fb.png"></a>
					                                                         </div>
					                                                      </td>
					                                                      <td style="font-size:1px; line-height:1px;" align="left" width="20">&nbsp;</td>
					                                                      <td align="center" height="43" width="43">
					                                                         <div class="imgpop">
					                                                            <a href="https://plus.google.com/u/0/118378364994508690262"><img alt="" src="https://shopify.cedcommerce.com/jet/images/Polygon-google.png"></a>
					                                                         </div>
					                                                      </td>
					                                                      <td style="font-size:1px; line-height:1px;" align="left" width="20">&nbsp;</td>
					                                                      <td align="center" height="43" width="43">
					                                                         <div class="imgpop">
					                                                            <a href="https://www.linkedin.com/company/cedcommerce"><img alt="" src="https://shopify.cedcommerce.com/jet/images/Polygon-linkedin.png"></a>
					                                                         </div>
					                                                      </td>
					                                                      <td align="center" height="43" width="43">
					                                                         <div class="imgpop">
					                                                            <a href="https://twitter.com/cedcommerce"><img alt="" src="https://shopify.cedcommerce.com/jet/images/polygon-tweet_1.png"></a>
					                                                         </div>
					                                                      </td>
					                                                   </tr>
					                                                </tbody>
					                                             </table>
					                                             <!-- end of Social icons -->
					                                          </td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                       <tr>
					                                          <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="25">&nbsp;</td>
					                                       </tr>
					                                       <!-- Spacing -->
					                                    </tbody>
					                                 </table>
					                              </td>
					                           </tr>
					                        </tbody>
					                     </table>
					                  </td>
					               </tr>
					            </tbody>
					         </table>
					         <!-- End of footer -->
					               </td>
					            </tr>
					         </table>
					      </td>
					   </tr>
					</table>
	
					 </body>
					   </html>'.chr(10);
	
	
		mail($mer_email,$subject, $etx_mer, $headers_mer);
	}
	
	
}
?>