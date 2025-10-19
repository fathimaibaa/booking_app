<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f7; margin:0; padding:0;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #0d6efd; padding: 20px; text-align: center; color: #ffffff; font-size: 24px;">
                            Booking Confirmation
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 20px; color: #333333; line-height: 1.6;">
                            <p>Hi <strong>{{ $booking->customer_name }}</strong>,</p>

                            <p>Thank you for booking with us! Here are your booking details:</p>

                            <table cellpadding="5" cellspacing="0" width="100%" style="border: 1px solid #ddd; border-radius: 5px;">
                                <tr style="background-color: #f4f4f4;">
                                    <th align="left">Booking Date</th>
                                    <td>{{ $booking->booking_date }}</td>
                                </tr>
                                <tr>
                                    <th align="left">Service Type</th>
                                    <td>{{ $booking->service_type }}</td>
                                </tr>
                                <tr style="background-color: #f4f4f4;">
                                    <th align="left">Status</th>
                                    <td>{{ $booking->status }}</td>
                                </tr>
                                <tr>
                                    <th align="left">Email</th>
                                    <td>{{ $booking->email }}</td>
                                </tr>
                            </table>

                            <p style="margin-top: 20px;">We look forward to serving you.</p>

                            <p>Best regards,<br><strong>Booking System Team</strong></p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f4f4f7; text-align: center; padding: 15px; color: #888; font-size: 12px;">
                            &copy; {{ date('Y') }} Booking System. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
