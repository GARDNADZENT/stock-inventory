<!doctype html>
<html>
<head><meta charset="utf-8"><style>body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;color:#1f2933;line-height:1.6;padding:24px;max-width:560px;margin:0 auto}.brand{font-size:1.25rem;font-weight:800;letter-spacing:.08em;margin-bottom:24px}.btn{display:inline-block;padding:12px 24px;background:#0f766e;color:#fff;text-decoration:none;border-radius:8px;font-weight:600;margin:16px 0}.muted{color:#667085;font-size:.875rem}</style></head>
<body>
<div class="brand">MAASAI SHOP</div>
<h2>Reset your password</h2>
<p>Hi{{ $user->name ? ' ' . $user->name : '' }},</p>
<p>We received a request to reset your password. Click the button below to set a new one.</p>
<p><a href="{{ $url }}" class="btn">Reset password</a></p>
<p class="muted">This link expires in {{ $expiresMinutes }} minutes. If you did not request a password reset, you can ignore this email.</p>
</body>
</html>
