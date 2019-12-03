@extends('template.app')

@section('content')
<table>
    <thead>
        <tr>
            <th width="1">
                <master-checkbox-input
                name="master"
                :total="3"
                listen="select-single"
                fire="select-multiple"
                ></master-checkbox-input>
            </th>
            <th>
                Table Header
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <checkbox-input
                name="record-1"
                :total="record-1"
                listen="select-single"
                fire="select-multiple"
                true-value="1"
                ></checkbox-input>
            </td>
            <td> LOrem ipsum sit emit, consectetuer </td>
        </tr>
        <tr>
                <td>
                    <checkbox-input
                    name="record-2"
                    :total="record-2"
                    listen="select-single"
                    fire="select-multiple"
                    true-value="2"
                    ></checkbox-input>
                </td>
                <td> LOrem ipsum sit emit, consectetuer </td>
            </tr>
            <tr>
                    <td>
                        <checkbox-input
                        name="record-3"
                        :total="record-3"
                        listen="select-single"
                        fire="select-multiple"
                        true-value="3"
                        ></checkbox-input>
                    </td>
                    <td> LOrem ipsum sit emit, consectetuer </td>
                </tr>
    </tbody>
</table>

@endsection
