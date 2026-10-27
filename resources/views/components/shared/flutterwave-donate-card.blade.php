@php($payLink = config('services.flutterwave.pay_link'))
<div class="give-card">
    <span class="give-badge">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M20.8 8.8c0 5.2-8.8 10.3-8.8 10.3S3.2 14 3.2 8.8A4.6 4.6 0 0 1 12 6.5a4.6 4.6 0 0 1 8.8 2.3Z"></path></svg>
        Secure online giving
    </span>
    <h3>Give online in minutes</h3>
    <p>Choose your own amount and complete your gift on Flutterwave's secure checkout.</p>
    <ul class="check-list">
        <li><svg fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12 4 4L19 6"></path></svg><span>You decide how much to give. Every gift helps.</span></li>
        <li><svg fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12 4 4L19 6"></path></svg><span>Payment details are entered on Flutterwave's page, never on this website.</span></li>
        <li><svg fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12 4 4L19 6"></path></svg><span>Our team confirms each payment before a receipt is issued.</span></li>
    </ul>
    @if($payLink)
        <a class="btn btn-primary give-btn" href="{{ $payLink }}" target="_blank" rel="noopener noreferrer">
            Donate securely
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg>
        </a>
        <span class="form-note">Opens Flutterwave's secure payment page in a new tab.</span>
    @else
        <a class="btn btn-primary give-btn" href="{{ route('get-involved') }}#donation-pledge">
            Record a donation pledge
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg>
        </a>
        <span class="form-note">Online payment is not available right now. A pledge lets our team follow up with you.</span>
    @endif
</div>
