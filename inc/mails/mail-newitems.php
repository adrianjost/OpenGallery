<?php
function newitemmail($newitems,$fname,$link,$uid,$uname){
return '
<html><body>
    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border-radius:6px;background-color:none">
        <tbody>
            <tr>
                <td align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="600">
                        <tbody>
                            <tr>
                                <td>
                                    <h1 style="font-family:Helvetica;font-size:28px;margin-bottom:30px;margin-top:0;padding:0">OpenGallery</h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border-radius:6px;background-color:#ffffff">
                        <tbody>
                            <tr>
                                <td align="left" valign="top" style="line-height:150%;font-family:Helvetica;font-size:14px;color:#333333;padding:20px">
                                    <h2 style="font-size:22px;line-height:28px;margin:0 0 12px 0">
                                        <b>'.$newitems.'</b> new File'.(($newitems==1)?'':'s').' on <b>'.$fname.'</b>
                                    </h2>
                                    <div>
                                        <p style="padding:0 margin:0;">
                                            Hey '.$uname.',<br>
                                            someone has uploaded some new files to an gallery you are following.
                                        </p>
                                    </div>
                                    <a href="'.$link.'" style="color:#ffffff!important;display:inline-block;font-weight:500;font-size:16px;line-height:42px;font-family:Helvetica,Arial,sans-serif;width:auto;white-space:nowrap;min-height:42px;margin:12px 5px 12px 0;padding:0 22px;text-decoration:none;text-align:center;border:0;border-radius:3px;vertical-align:top;background-color:#5d5d5d!important" target="_blank">
                                        <span style="display:inline;font-family:Helvetica,Arial,sans-serif;text-decoration:none;font-weight:500;font-style:normal;font-size:16px;line-height:42px;border:none;background-color:#5d5d5d!important;color:#ffffff!important">Check them out!</span>
                                    </a>
                                    <br>
                                    <div>
                                        <p style="padding:0 0 10px 0">
                                            Check your Abo here: <a href="https://gallery.hackedit.de/mail.php?id='.$uid.'" style="color:#336699" target="_blank"">click this link</a>
                                        </p>
                                        <p style="padding:0 0 10px 0">
                                            If you received this email by mistake, simply <a href="https://gallery.hackedit.de/mail-handle.php?delete='.$uid.'" style="color:#336699" target="_blank"">click this link</a> to unsubscribe from our list and delete this mail.
                                        </p>
                                        <p style="padding:0 0 10px 0">
                                            For questions about this list, please contact:
                                            <br>
                                            <a href="mailto:homepage@hackedit.de" style="color:#336699" target="_blank">
                                                homepage@hackedit.de
                                            </a>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top">
                    <table border="0" cellpadding="20" cellspacing="0" width="600">
                        <tbody>
                            <tr>
                                <td align="center" valign="top"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body></html>
';
}
?>