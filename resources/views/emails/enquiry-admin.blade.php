<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Enquiry</title>
</head>
<body style="margin:0;padding:0;background:#f5f5f5;font-family:Arial,Helvetica,sans-serif;color:#111;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f5f5f5;padding:24px 12px;">
    <tr>
      <td align="center">
        <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:12px;overflow:hidden;">
          <tr>
            <td style="background:#f2e600;padding:22px 28px;">
              <h1 style="margin:0;font-size:22px;line-height:1.3;color:#111;">New Whizseed Enquiry</h1>
            </td>
          </tr>
          <tr>
            <td style="padding:28px;">
              <p style="margin:0 0 18px;font-size:15px;line-height:1.6;">You received a new enquiry from <strong>{{ $enquiry->name }}</strong>.</p>
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;font-size:14px;">
                <tr>
                  <td style="padding:10px 0;border-bottom:1px solid #eee;width:140px;color:#666;">Name</td>
                  <td style="padding:10px 0;border-bottom:1px solid #eee;">{{ $enquiry->name }}</td>
                </tr>
                <tr>
                  <td style="padding:10px 0;border-bottom:1px solid #eee;color:#666;">Email</td>
                  <td style="padding:10px 0;border-bottom:1px solid #eee;"><a href="mailto:{{ $enquiry->email }}" style="color:#111;">{{ $enquiry->email }}</a></td>
                </tr>
                <tr>
                  <td style="padding:10px 0;border-bottom:1px solid #eee;color:#666;">Mobile</td>
                  <td style="padding:10px 0;border-bottom:1px solid #eee;">{{ $enquiry->mobile }}</td>
                </tr>
                <tr>
                  <td style="padding:10px 0;border-bottom:1px solid #eee;color:#666;">Subject</td>
                  <td style="padding:10px 0;border-bottom:1px solid #eee;">{{ $enquiry->subject ?: '—' }}</td>
                </tr>
                <tr>
                  <td style="padding:10px 0;border-bottom:1px solid #eee;color:#666;">Service</td>
                  <td style="padding:10px 0;border-bottom:1px solid #eee;">{{ $enquiry->service_slug ?: '—' }}</td>
                </tr>
                <tr>
                  <td style="padding:10px 0;color:#666;vertical-align:top;">Message</td>
                  <td style="padding:10px 0;">{{ $enquiry->description ?: '—' }}</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
