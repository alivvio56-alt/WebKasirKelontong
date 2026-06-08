<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($judul) ? $judul . ' - ' : '' ?>Sistem POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body { background:#f3f6fb; overflow-x:hidden; }
        .sidebar { min-height:100vh; background:linear-gradient(180deg,#111827,#1f2937); padding:20px 14px; }
        .brand-box { color:#fff; font-weight:700; font-size:1.25rem; padding:12px; border-radius:16px; background:rgba(255,255,255,.08); }
        .sidebar a { display:block; padding:12px 14px; color:#d1d5db; text-decoration:none; border-radius:12px; margin-top:6px; }
        .sidebar a:hover, .sidebar a.active { background:#2563eb; color:#fff; }
        .content { padding:24px; }
        .card { border:0; border-radius:18px; box-shadow:0 10px 30px rgba(15,23,42,.07); }
        .btn { border-radius:10px; }
        .table thead th { background:#f8fafc; color:#475569; font-size:.85rem; }
        .rupiah { white-space:nowrap; }
        @media(max-width:768px){ .sidebar{min-height:auto;} .content{padding:16px;} }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
