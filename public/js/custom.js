jQuery.each(data, function(index, value) {
    $("#table_div").append("<tr><td>" + value + "</td></tr>");
});

var total_loan = document.getElementById('total_loan');
total_loan.value = 0.00;
var amount_loaned = document.getElementById('amount_loaned');
amount_loaned.value = 0.00;
var daily_payment = document.getElementById('daily_payment');
daily_payment.value = 0.00;

amount_loaned.addEventListener('input',function() {
    total_loan.value = (this.value * 1.2);
    daily_payment.value = Math.ceil(this.value * 1.2 / 52);
});

$(document).ready(function(){
    $('#setButton').click(function () {
        var date_loaned  = document.getElementById('date_loaned');
        var due_date = document.getElementById('due_date');
        var result = new Date(date_loaned.value);
        result.setDate(result.getDate() + 60);
        alert(result);
        alert(result.getMonth() + 1 + 'Month --- Day' + result.getDate() );
        var month = (result.getMonth() + 1 ) >= '10' ? (result.getMonth() + 1) : '0' + (result.getMonth() + 1);
        var day = result.getDate() >= '10' ? result.getDate() : '0' + result.getDate();
        alert(result.getFullYear() + '-' + month + '-' + day);
        due_date.value = result.getFullYear() + '-' + month + '-' + day;
    })
});
