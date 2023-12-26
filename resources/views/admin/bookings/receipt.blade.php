<html>

<head>

  <style>
    @media print {
      .printoff {
        display: none;
      }
    }
  </style>

  <title>{{ env('APP_NAME', 'Lexis') }}</title>
</head>

<body onload="">
  {{-- window.print(); --}}
  <div class="printoff" style="display: flex; justify-content: flex-end; margin: 20px 10px">
    <a href="{{route('admin.dashboard')}}" style="display: flex; justify-content: center;align-items: center; background: brown; color: white; padding: 10px 15px">Go Back</a>
  </div>
  <table style="font-size: 14px; font-family: Arial, Helvetica, sans-serif" width="300px" cellspacing="1" cellpadding="2">
    <tbody>
      <tr>
        <td colspan="2" align="center">
           <div class="left">
      <img id="img-uploaded"
        src="@if (isset(systemDetails()['logo'])) {{ systemDetails()['logo'] }} @else http://placehold.it/140x70 @endif"
        alt="{{ systemDetails()['name'] }}" />
    </div>
          <font size="4" face="arial" color="#000000"><b>{{ systemDetails()['name'] }}</b><br>
            <font size="2">
              Address</font>
          </font>
        </td>
      </tr>

      <tr>
        <td colspan="2" style="border-top: 1px solid #333333" height="25px" align="center">
          <font face="arial">Transaction No.: <b>{{ $booking->trx }}</b></font>
        </td>
      </tr>

      <tr>
        <td colspan="2" style="border-top: 1px solid #333333" height="25px" align="center">
          <font face="arial"> <b>{{ $booking->status == 2 ? 'Reservation' : '' }} Booking Receipt</b></font>
        </td>
      </tr>

      <tr>
        <td style="border-bottom: 1px solid #333333" colspan="2" height="23px">
          <div style="text-align: center;" bis_skin_checked="1">
            <font face="arial"><b>

                {{ date('F j, Y, g:i a', strtotime($booking->created_at)) }}

              </b></font>
          </div>

        </td>
      </tr>
    </tbody>
  </table>
  <table style="font-size: 14px; font-family: Arial, Helvetica, sans-serif" width="300px" cellspacing="0"
    cellpadding="2">
    <tbody>
      <tr>
        <td height="20px">
          <font face="arial">
            <b>ITEM</b>
          </font>
        </td>
        <td align="right">
          <font face="arial">
            <b>PRICE</b>
          </font>
        </td>
        <td align="right">
          <font face="arial">
            <b>AMOUNT</b>
          </font>
        </td>
      </tr>
      <tr>
      </tr>

      <tr>

        <td style="line-height: 1.1em">
          <font face="arial">

            Booking: {{ $booking->room->name ?? null }}
            <br>
          </font>
        </td>
        <td style="line-height: 1.1em" align="center">
          <font face="arial">

            {{ do_money($booking->room->price) ?? null }}
            <br>
          </font>
        </td>
        <td style="line-height: 1.1em" align="right">
          <font face="arial">

            {{ do_money($booking->room->price * $booking->duration) ?? null }}
            <br>
          </font>
        </td>
      </tr>

      <tr>
        <td colspan="4" style="border-top: 2px solid #333" valign="top">

          <table width="100%" cellspacing="0" cellpadding="1">
            <tbody>
              <tr>

                <td valign="top">
                  <table style="font-size: 13px" width="100%" cellspacing="0" cellpadding="1">

                    <tbody>
                      <tr>
                        <td style="border-top: 0px dotted #333333" height="30px" align="right">
                          <font face="arial">Total:</font>
                        </td>
                        <td style="border-top: 1px dotted #333333; border-bottom: 1px dotted #333333" height="30px"
                          align="right">
                          <font face="arial"><b>
                              {{ do_money($booking->amount) }}
                            </b></font>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td>&nbsp;</td>
                <td style="border-left: 1px solid #333" valign="top">
                  <table style="font-size: 13px" width="100%" cellspacing="0" cellpadding="1">
                    <tbody>
                      <tr>
                        <td style="border-top: 0px dotted #333333" height="30px" align="right">
                          <font face="arial">Discount:</font>
                        </td>
                        <td style="border-top: 0px dotted #333333" height="30px" align="right">
                          @php
                            $discount = App\Models\Discount::where('tracking_no', $booking->trx)->first();
                            $discountAmount = 0;
                            if ($discount) {
                                $discountAmount = $discount->amount;
                            }
                          @endphp
                          <font face="arial">{{ do_money($discountAmount) }}</font>
                        </td>
                      </tr>

                      <tr>
                        <td style="border-top: 0px solid #333333" height="30px" align="right">
                          <font face="arial">Amount Paying:</font>
                        </td>
                        <td style="border-top: 0px solid #333333" height="30px" align="right">
                          <font face="arial">
                            {{ do_money($booking->amount) }}
                          </font>
                        </td>
                      </tr>
                      <tr>
                        <td height="30px" align="right">
                          <font face="arial">Amount Paid:</font>
                        </td>
                        <td height="30px" align="right">
                          <font face="arial">
                            @php
                              $amountPaid = App\Models\Payment::where('trx', $booking->uid)->sum('amount');
                            @endphp
                            {{ do_money($amountPaid) }}
                          </font>
                        </td>
                      </tr>

                      <tr>
                        <td height="30px" align="right">
                          <font face="arial">TIP:</font>
                        </td>
                        <td height="30px" align="right">
                          <font face="arial">₦0.00</font>
                        </td>
                      </tr>

                      <tr>


                        <td style="border-top: 1px dotted #333333; border-bottom: 1px dotted #333333" height="30px"
                          align="right">
                          <font face="arial">
                            Debt:
                          </font>
                        </td>
                        <td style="border-top: 1px dotted #333333; border-bottom: 1px dotted #333333" height="30px"
                          align="right">
                          <font face="arial"><b>
                              @php
                                $debt = App\Models\Debt::where('tracking_no', $booking->trx)
                                    ->where('cleared', 0)
                                    ->first();
                              @endphp
                              @if ($debt)
                                {{ do_money($debt->amount - $debt->amount_paid) }}
                              @else
                                No Debt
                              @endif
                            </b></font>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>

              </tr>
            </tbody>
          </table>

        </td>
      </tr>

      <tr>
        <td colspan="4" height="40px" align="left"><br>
          <font size="2" face="arial"><b>PAID WITH: </b>

            @php
              $paidWith = App\Models\Payment::where('trx', $booking->uid)
                  ->where('amount', '>', 0)
                  ->get();
            @endphp
            @forelse ($paidWith as $item)
              {{ Str::ucfirst($item->name) }} ({{ do_money($item->amount) }})
            @empty
              Payment pending
            @endforelse
          </font><br><br>
        </td>
      </tr>
      <tr>
        <td colspan="4" height="30px" align="center">
          <font face="arial">Attendant: <b>
              {{ $booking->user->name ?? null }}
            </b></font>
        </td>
      </tr>
      <tr>
        <td colspan="4" style="border-top: 2px solid #333333" height="50px" align="center">
          <!--<font face="arial" size="1"><b>T & C:</b> Service paid for: No refund of money after payment.</font>-->
          <div style="display: block; margin-top: 3px" bis_skin_checked="1">
            <font face="arial"><b><i>Thank you for your patronage! We look forward to seeing you again...</i></b>
            </font>
          </div>
        </td>
      </tr>
    </tbody>
  </table>



  <br>

</body>

</html>
