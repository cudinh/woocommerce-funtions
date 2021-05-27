add_filter('woocommerce_bacs_accounts', '__return_false');
 
add_action( 'woocommerce_email_before_order_table', 'mrpi_email_instructions', 10, 3 );
function mrpi_email_instructions( $order, $sent_to_admin, $plain_text = false ) {
 
    if ( ! $sent_to_admin && 'bacs' === $order->get_payment_method() && $order->has_status( 'on-hold' ) ) {
        mrpi_bank_details( $order->get_id() );
    }
 
}
 
add_action( 'woocommerce_thankyou_bacs', 'mrpi_thankyou_page' );
function mrpi_thankyou_page($order_id){
    mrpi_bank_details($order_id);
}
 
function mrpi_bank_details( $order_id = '' ) {
    $bacs_accounts = get_option('woocommerce_bacs_accounts');
    if ( ! empty( $bacs_accounts ) ) {
        ob_start();
        echo '<table style=" border: 1px solid #ddd; border-collapse: collapse; width: 100%; ">';
        ?>
        <tr>
            <td colspan="2" style="border: 1px solid #eaeaea;padding: 6px 10px;"><strong>Thông tin chuyển khoản</strong></td>
        </tr>
        <?php
        foreach ( $bacs_accounts as $bacs_account ) {
            $bacs_account = (object) $bacs_account;
            $account_name = $bacs_account->account_name;
            $bank_name = $bacs_account->bank_name;
            $stk = $bacs_account->account_number;
            $icon = $bacs_account->iban;
            ?>
            <tr>
                <td style="width: 200px;border: 1px solid #eaeaea;padding: 6px 10px;"><?php if($icon):?><img src="<?php echo $icon;?>" alt=""/><?php endif;?></td>
                <td style="border: 1px solid #eaeaea;padding: 6px 10px;">
                    <strong>STK:</strong> <?php echo $stk;?><br>
                    <strong>Chủ tài khoản:</strong> <?php echo $account_name;?><br>
                    <strong>Chi Nhánh:</strong> <?php echo $bank_name;?>
                </td>
            </tr>
            <?php
        }
        echo '</table>';
        echo ob_get_clean();;
    }
 
}
