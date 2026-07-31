<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank you</title>
</head>
<body style="margin:0;padding:0;background:#f5f5f5;font-family:Arial,Helvetica,sans-serif;color:#111;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f5f5f5;padding:24px 12px;">
    <tr>
      <td align="center">
        <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:12px;overflow:hidden;">
          <tr>
            <td style="background:#f2e600;padding:22px 28px;">
              <h1 style="margin:0;font-size:22px;line-height:1.3;color:#111;">Thank you for contacting Whizseed</h1>
            </td>
          </tr>
          <tr>
            <td style="padding:28px;">
              <p style="margin:0 0 12px;font-size:15px;line-height:1.6;">Dear {{ $enquiry->name }},</p>
              <p style="margin:0 0 12px;font-size:15px;line-height:1.6;">
                We received your enquiry@if($enquiry->subject) regarding <strong>{{ $enquiry->subject }}</strong>@endif.
                Our expert will contact you shortly.
              </p>
              <p style="margin:0 0 12px;font-size:15px;line-height:1.6;">
                If you need immediate help, reply to this email or reach us on WhatsApp.
              </p>
              <p style="margin:24px 0 0;font-size:15px;line-height:1.6;">
                Best regards,<br>
                Team Whizseed
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
