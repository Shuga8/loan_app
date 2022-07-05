<?php

require APPROOT . '/view/includes/head.php';

?>

<div id="loan-container">
    <div id="all-loans">

        <div id="loan-form">
            <h2>Apply For Loans</h2>
            <br>
            <span class="invalidFeedback">
                <?php echo $data['loanError']; ?>
            </span>
            <form action="<?php echo SITEURL; ?>/loans/applyForLoan" method="POST">
                <div class="loan_info_field">
                    <select name="loan_for" id="">
                        <option disabled>Loan For</option>
                        <option value="Buisness">For Buisness</option>
                        <option value="Education">For Education</option>
                        <option value="Carear">For Carear</option>
                        <option value="Others">For Others</option>
                    </select>
                </div>
                <div class="loan_info_field">
                    <select name="loan_amount" id="">
                        <option disabled>Choose An Amount</option>
                        <option value="10000">Ten Thousand Naira (#10,000)</option>
                        <option value="50000">Fifty Thousand Naira (#50,000)</option>
                        <option value="100000">Hundred Thousand Naira (#100,000)</option>
                        <option value="150000">One Hundred And Fifty Thousand (#150,000)</option>
                        <option value="200000">Two Hundred Thousand (#200,000)</option>
                        <option value="300000">Three Hundred Thousand (#300,000)</option>
                        <option value="350000">Three Hundred And Ffity Thousand (#350,000)</option>
                        <option value="500000">Five Hundred Thousand (#500,000)</option>
                    </select>
                </div>
                <div class="loan_info_field">
                    <select name="loan_repayment_day" id="">
                        <option disabled>Choose A Repayment Date</option>
                        <option value="one">One Month</option>
                        <option value="two">Two Months</option>
                        <option value="three">Three Months</option>
                    </select>
                </div>
                <button type="submit" name="apply" id="button">Apply <i
                        class="fa-solid fa-right-to-bracket"></i></button>
            </form>

            <?php

            if (empty($data['loans'])) {
                echo '<a class="btn bg-blue white">No pending Loans <i class="fa-solid fa-circle-check"></i></a>';
            } else {
                echo '<a class="btn bg-green white">View Pending Loans</a>';
            }

            ?>


            <a class="btn bg-red white">Pay Back All Loans</a>
        </div>

    </div>
</div>

<?php

require APPROOT . '/view/includes/footer.php';

?>