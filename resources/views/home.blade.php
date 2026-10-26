<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 860px; margin: 2rem auto; padding: 0 1rem; color: #1f2937; }
        h1 { margin-bottom: .25rem; }
        p.lead { color: #6b7280; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin: 1.5rem 0; }
        th, td { text-align: left; padding: .5rem; border-bottom: 1px solid #e5e7eb; }
        .status { font-size: .8rem; padding: .1rem .5rem; border-radius: 999px; background: #e5e7eb; }
        .status.open { background: #d1fae5; color: #065f46; }
        .status.ended { background: #fee2e2; color: #991b1b; }
        pre { background: #f3f4f6; padding: 1rem; overflow-x: auto; border-radius: 6px; }
    </style>
</head>
<body>
    <h1>📻 {{ config('app.name') }}</h1>
    <p class="lead">Radio &amp; TV station contests. Listeners enter, sponsors get leads, someone wins a prize.</p>

    <table>
        <thead>
            <tr><th>#</th><th>Contest</th><th>Station</th><th>Prize</th><th>Status</th><th>Ends</th></tr>
        </thead>
        <tbody>
            @forelse ($contests as $contest)
                <tr>
                    <td>{{ $contest->id }}</td>
                    <td>{{ $contest->title }}</td>
                    <td>{{ $contest->station->name }}</td>
                    <td>{{ $contest->prize }}</td>
                    <td><span class="status {{ $contest->status() }}">{{ $contest->status() }}</span></td>
                    <td>{{ $contest->ends_at->diffForHumans() }}</td>
                </tr>
            @empty
                <tr><td colspan="6">No contests yet. Did you run <code>php artisan db:seed</code>?</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>API</h2>
<pre>
curl {{ config('app.url') }}/api/contests
curl {{ config('app.url') }}/api/contests/1
curl -X POST {{ config('app.url') }}/api/contests/1/entries \
     -H 'Accept: application/json' -H 'Content-Type: application/json' \
     -d '{"name": "Jane Listener", "email": "jane@example.com"}'
</pre>
</body>
</html>
