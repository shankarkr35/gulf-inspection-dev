<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="padding" style="padding: 20px;">
    <div class="containet">
      <div class="email_tamplate" style="display: flex; justify-content: space-between;     border-bottom: 1px solid black;  padding-bottom: 14px;">
        <div class="logo">
          <img src="https://static.wixstatic.com/media/c30441_d4b3a5f970494b86b7dbe12cca1df739~mv2.png/v1/fill/w_218,h_158,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/new%20logo.png" alt="" style="width: 142px;  height: 76px; object-fit: cover;">
        </div>
        <div class="content_header" style="text-align: center; width: 100%;">
          <h1 style="font-size: 24px; margin-bottom: 0;">GULF INSPECTION INTERNATIONAL CO. K.S.C.</h1>
          <p style="font-size: 14px; margin: 0;">PO BOX 24993, Safat 13110, Kuwait.</p>
          <p style="font-size: 14px; margin: 0;"> Tel.: +965 34735121, Fax: 965 24733045</p>
          <p style="font-size: 14px; margin: 0;">Email: mgmtürgico.net, Website: www.glico.net</p>
        </div>
      </div>
    </div>
    <div class="project_name">
      <h2 style="text-align: center; font-size: 20px; margin-top: 30px; margin-bottom: 32px;">Project Report Detail</h2>
    </div>
    <div class="project_date">
      <p style="text-align: end;">Date : <?php echo date('d-m-Y',strtotime($report_date)) ?></p>
    </div>
    <table>
      <tr>
        <td style="  font-size: 16px;  padding: 10px;">Client Name</td>
        <td style="  font-size: 16px;  padding: 10px;">:</td>
        <td style="  font-size: 16px;  padding: 10px;"><?php echo $company_name ?></td>
      </tr>
      <tr>
        <td style="  font-size: 16px;  padding: 10px;">Project</td>
        <td style="  font-size: 16px;  padding: 10px;">:</td>
        <td style="  font-size: 16px;  padding: 10px;"><?php echo $report_title ?></td>
      </tr>
      <tr>
        <td style="  font-size: 16px;  padding: 10px;">Location</td>
        <td style="  font-size: 16px;  padding: 10px;">: <?php echo $cityName ?></td>
        <td style="  font-size: 16px;  padding: 10px;">Area : <?php echo $governorateName ?></td>
        <td style="  font-size: 16px;  padding: 10px;">Country : Kuwait</td>
      </tr>
      <tr>
        <td style="  font-size: 16px;  padding: 10px;">Division </td>
        <td style="  font-size: 16px;  padding: 10px;">:</td>
        <td style="  font-size: 16px;  padding: 10px;">Inspection</td>
      </tr>
      <tr>
        <td style="  font-size: 16px;  padding: 10px;">GIICO Job Ref No</td>
        <td style="  font-size: 16px;  padding: 10px;">:</td>
        <td style="  font-size: 16px;  padding: 10px;"><?php echo $giico_job_ref ?></td>
        <td style="  font-size: 16px;  padding: 10px;">Rev: 1 - 10</td>
      </tr>
      <tr>
        <td style="  font-size: 16px;  padding: 10px;">Client Ref No.</td>
        <td style="  font-size: 16px;  padding: 10px;">:</td>
        <td style="  font-size: 16px;  padding: 10px;"><?php echo $client_ref_no ?></td>
      </tr>
      <tr>
        <td style="  font-size: 16px;  padding: 10px;">Download Report</td>
        <td style="  font-size: 16px;  padding: 10px;">:</td>
        <td style="  font-size: 16px;  padding: 10px;"><a href="<?php echo $login_url ?>" style="color: black;" target="_blank">Login</a></td>
      </tr>
    </table>
    <div class="report_title" style="display: flex; margin-top: 10px;">
      <div class="img_qr">
        <img src="<?php echo base_url('images/').$qr_image ?>" alt="" style="margin-left: 10px;  width: 126px;  height: 126px;">
      </div>
      <div class="content">
        <p style="font-size: 14px; margin-left: 20px; line-height: 20px;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem ipsam maxime blanditiis dolorem nemo, et rem
          necessitatibus excepturi quas saepe, ex adipisci corrupti minus, sequi deserunt natus doloribus quo itaque?
        </p>
      </div>
    </div>
  </div>
</body>

</html>