<table style="border: 1px solid black">
    <tbody>
        <tr></tr>
        <tr>
            <th></th>
            <th style="background-color: #a1e3ff">テーブル名称</th>
            <th>管理者と店舗の中間テーブル</th>
        </tr>
        <tr>
            <th></th>
            <th style="background-color: #a1e3ff">テーブル名</th>
            <th>
                {{ data_get($table, 'name') }}
            </th>
        </tr>
        <tr>
            <th></th>
            <th style="background-color: #a1e3ff">概要</th>
            <th>
                {{ data_get($table, 'description') }}
            </th>
        </tr>
    </tbody>
</table>
<table style="border: 1px solid black">
    <thead>
        <tr>
            <th></th>
            <th style="background-color: #a1e3ff">No.</th>
            <th style="background-color: #a1e3ff">カラム名</th>
            <th style="background-color: #a1e3ff">データ型</th>
            <th style="background-color: #a1e3ff">桁数</th>
            <th style="background-color: #a1e3ff">Not Null</th>
            <th style="background-color: #a1e3ff">デフォルト</th>
            <th style="background-color: #a1e3ff">備考</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($columns as $key => $column)
            <tr>
                <td></td>
                <td>{{ $key + 1 }}</td>
                <td>{{ $column->Field }}</td>
                <td>{{ $column->Type }}</td>
                <td>{{ $column->Type }}</td>
                <td>{{ $column->Null }}</td>
                <td>{{ $column->Default }}</td>
                <td>{{ $column->Comment }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
