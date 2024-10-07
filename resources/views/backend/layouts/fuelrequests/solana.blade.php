@extends('backend.layouts.master')

@section('main-content')
<div class="card">
    <h5 class="card-header">Pay with Solana</h5>
    <div class="card-body">
        <p><strong>Fuel Request ID:</strong> {{ $fuelrequest->order_number }}</p>
        <p><strong>Amount (Naira):</strong> {{ number_format($amountNaira, 2) }}</p>
        <p><strong>Equivalent Amount (Solana):</strong> {{ number_format($amountSol, 8) }}</p>
        <p><strong>Recipient's Public Key:</strong> {{ $recipientPublicKey }}</p>

        <button id="connectWalletBtn">Connect Solana Wallet</button>

        <div id="paymentInfo" style="display: none;">
            <p>Wallet Connected!</p>
            <button id="makePaymentBtn">Make Payment</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@solana/web3.js@latest/lib/index.umd.min.js"></script>
<script>
    const recipientPublicKey = "{{ $recipientPublicKey }}";
    const amountSol = parseFloat("{{ $amountSol }}");
    const network = "https://api.devnet.solana.com"; // or "https://api.testnet.solana.com"

    const connectWalletBtn = document.getElementById('connectWalletBtn');
    const paymentInfo = document.getElementById('paymentInfo');
    const makePaymentBtn = document.getElementById('makePaymentBtn');

    connectWalletBtn.addEventListener('click', async () => {
        try {
            const provider = window.solana;
            if (provider) {
                await provider.connect();
                paymentInfo.style.display = 'block';
                connectWalletBtn.style.display = 'none';
            } else {
                console.error('Solana provider not found. Please install Phantom wallet.');
            }
        } catch (error) {
            console.error('Error connecting wallet:', error);
        }
    });

    makePaymentBtn.addEventListener('click', async () => {
        try {
            const provider = window.solana;
            if (provider && provider.isConnected) {
                const fromPublicKey = provider.publicKey.toString();
                const toPublicKey = recipientPublicKey;
                const lamports = Math.floor(amountSol * 1e9); // Convert SOL to lamports
                const connection = new solana.Web3.Connection(network);

                const transaction = new solana.Transaction().add(
                    solana.SystemProgram.transfer({
                        fromPubkey: fromPublicKey,
                        toPubkey: toPublicKey,
                        lamports: lamports,
                    })
                );

                const signature = await provider.signAndSendTransaction(transaction);
                console.log(`Transaction signature: ${signature}`);
                console.log('Payment successful!');
            } else {
                console.error('Wallet not connected.');
            }
        } catch (error) {
            console.error('Error making payment:', error);
        }
    });
</script>
@endsection
