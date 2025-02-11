<table>
    <tbody>
        <tr></tr>
        <tr>
            <th></th>
            <th colspan="3" style="text-align: center">テーブル一覧</th>
        </tr>
        <tr>
            <th></th>
            <th style="background-color: #a1e3ff">No.</th>
            <th style="background-color: #a1e3ff">テーブル名</th>
            <th style="background-color: #a1e3ff">備考</th>
        </tr>
        @foreach ($tables as $key => $table)
            <tr>
                <td></td>
                <td>{{ $key + 1 }}</td>
                <td>{{ data_get($table, 'name') }}</td>
                <td>
                    {{ data_get($table, 'title') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
