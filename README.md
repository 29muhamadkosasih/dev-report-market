{{ \Carbon\Carbon::parse($item->noQL->date_penawaran)->format('d-m-Y') }}

{{ number_format($item->unit_price, 2, ',', '.')?? 0 }}

utf8mb4_unicode_ci
