document.getElementById('paymentMethod').addEventListener('change', function() {
    const method = this.value;
    const bankDetails = document.getElementById('bankAccountDetails');
    if (method === 'bank') {
        bankDetails.style.display = 'block';
    } else {
        bankDetails.style.display = 'none';
    }
});

function processPayment() {
    const studentName = document.getElementById('studentName').value;
    const paymentAmount = document.getElementById('paymentAmount').value;
    const paymentMonth = document.getElementById('paymentMonth').value;
    const paymentMethod = document.getElementById('paymentMethod').value;
    const bankAccountNumber = paymentMethod === 'bank' ? document.getElementById('accountNumber').value : '';
    const bankAccountHolder = paymentMethod === 'bank' ? document.getElementById('accountHolder').value : '';
    const bankIFSCCode = paymentMethod === 'bank' ? document.getElementById('ifscCode').value : '';

    // Basic form validation
    if (!studentName || !paymentAmount || !paymentMonth || !paymentMethod) {
        alert('Please fill in all fields');
        return;
    }

    // Simulate payment processing
    setTimeout(() => {
        const transactionId = Math.random().toString(36).substr(2, 9).toUpperCase();

        document.getElementById('receiptName').textContent = studentName;
        document.getElementById('receiptAmount').textContent = paymentAmount;
        document.getElementById('receiptMonth').textContent = paymentMonth;
        document.getElementById('receiptMethod').textContent = paymentMethod;
        document.getElementById('receiptTransactionId').textContent = transactionId;
        document.getElementById('receiptDate').textContent = new Date().toLocaleString();

        document.getElementById('paymentResult').style.display = 'block';

        // Clear form fields
        document.getElementById('studentName').value = '';
        document.getElementById('paymentAmount').value = '';
        document.getElementById('paymentMonth').value = '';
        document.getElementById('paymentMethod').value = '';
        document.getElementById('accountNumber').value = '';
        document.getElementById('accountHolder').value = '';
        document.getElementById('ifscCode').value = '';

        savePaymentData(studentName, paymentAmount, paymentMonth, paymentMethod, transactionId, bankAccountNumber, bankAccountHolder, bankIFSCCode);

    }, 2000);
}

function savePaymentData(name, amount, month, method, transactionId, bankAccountNumber = '', bankAccountHolder = '', bankIFSCCode = '') {
    const paymentData = JSON.parse(localStorage.getItem('paymentData')) || [];
    paymentData.push({
        name,
        amount,
        month,
        method,
        transactionId,
        bankAccountNumber,
        bankAccountHolder,
        bankIFSCCode,
        date: new Date().toISOString()
    });
    localStorage.setItem('paymentData', JSON.stringify(paymentData));
}

function loadPaymentHistory() {
    const paymentData = JSON.parse(localStorage.getItem('paymentData')) || [];
    const paymentHistoryElement = document.getElementById('paymentHistory');
    
    if (paymentHistoryElement) {
        paymentHistoryElement.innerHTML = '';
        paymentData.forEach(payment => {
            const paymentItem = document.createElement('div');
            paymentItem.classList.add('payment-item');
            paymentItem.innerHTML = `
                <p><strong>${payment.name}</strong> paid ₹${payment.amount} for ${payment.month}</p>
                <p>Method: ${payment.method} | Date: ${new Date(payment.date).toLocaleString()}</p>
                <p>Transaction ID: ${payment.transactionId}</p>
            `;
            paymentHistoryElement.appendChild(paymentItem);
        });
    }
}

window.addEventListener('load', loadPaymentHistory);