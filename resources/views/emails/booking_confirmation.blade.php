<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
</head>
<body style="font-family: 'Inter', Arial, sans-serif; background-color: #fcf7f3; margin:0; padding:0;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 30px 0;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.08);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #f7d8c0, #f0b89e); padding: 25px; text-align: center; color: #6d4c41; font-size: 26px; font-weight: 700;">
                            Booking Confirmation
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px; color: #5a4d4b; line-height: 1.6;">
                            <p style="font-size: 16px;">Hi <strong>{{ $booking->customer_name }}</strong>,</p>

                            <p style="font-size: 16px;">Thank you for booking with us! Here are your booking details:</p>

                            <table cellpadding="10" cellspacing="0" width="100%" style="border-collapse: separate; border-spacing: 0; border-radius: 8px; overflow: hidden; border: 1px solid #e0dcdc;">
                                <tr style="background-color: #fcfaf8;">
                                    <th align="left" style="text-align:left; font-weight: 600;">Booking Date</th>
                                    <td>{{ $booking->booking_date }}</td>
                                </tr>
                                <tr>
                                    <th align="left" style="text-align:left; font-weight: 600;">Service Type</th>
                                    <td>{{ $booking->service_type }}</td>
                                </tr>
                                <tr style="background-color: #fcfaf8;">
                                    <th align="left" style="text-align:left; font-weight: 600;">Status</th>
                                    <td>
                                        @if($booking->status == 'Confirmed')
                                            <span style="background:#c8e6c9; color:#256029; padding: 3px 8px; border-radius: 12px; font-weight: 600;">{{ $booking->status }}</span>
                                        @elseif($booking->status == 'Pending')
                                            <span style="background:#fff3cd; color:#856404; padding: 3px 8px; border-radius: 12px; font-weight: 600;">{{ $booking->status }}</span>
                                        @else
                                            <span style="background:#f8d7da; color:#842029; padding: 3px 8px; border-radius: 12px; font-weight: 600;">{{ $booking->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th align="left" style="text-align:left; font-weight: 600;">Email</th>
                                    <td>{{ $booking->email }}</td>
                                </tr>
                            </table>

                            <p style="margin-top: 25px; font-size: 16px;">We look forward to serving you.</p>

                            <p style="font-size: 16px;">Best regards,<br><strong>Booking System Team</strong></p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #fcf7f3; text-align: center; padding: 20px; color: #888; font-size: 12px;">
                            &copy; {{ date('Y') }} Booking System. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
