@extends('layouts.patient')
@section('page')
@php
$hospital = $hospitaldata['hospital']
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--appointment header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('patient.home') }}" class="btn btn-danger m-2">Home</a>
        </div>
        <!--appointment history-->
        <section>
            <div class="container-fluid mt-4">
                <!--appointment item-->
                <div class="col-md-6 col-xl-12 item">
                    <div class="row">
                        <p scope="col">Name : {{ $hospital->name }}</p>
                        <p scope="col">City : {{ $hospital->city }}</p>
                        <p scope="col">Town : {{ $hospital->town }} </p>
                        <p scope="col">Adress : {{ $hospital->address }}</p>
                        <p scope="col">Doctors : {{ $hospital->doctors ?? "N/A" }}</p>
                        <p scope="col">Nurses : {{ $hospital->nurses ?? "N/A" }}</p>
                        <p scope="col">Status: @if ($hospital->status)
                            <span class="badge badge-danger">Closed</span>
                            @else
                            <span class="badge badge-success">Open</span>
                            @endif</p>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
@endsection
