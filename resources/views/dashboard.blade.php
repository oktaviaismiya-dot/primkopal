@extends('main')

@section('title', 'Dashboard Koperasi')

@section('content')
<h3>Selamat Datang {{ Auth::user()->role->nama }}</h3>
<div class="cards">
    <div class="card">
        <div class="card-title">
            <i class="ph ph-users"></i>
            <p>Nasabah</p>
        </div>
        <span>120</span>
        <small class="trend up">+5 Hari Ini</small>
    </div>

    <div class="card">
        <div class="card-title">
            <i class="ph ph-bank"></i>
            <p>Simpanan</p>
        </div>
        <span>Rp. 20.000.000</span> <br>
        <small class="trend up">+Rp. 1.500.000</small>
    </div>

    <div class="card">
        <div class="card-title">
            <i class="ph ph-wallet"></i>
            <p>Pinjaman</p>
        </div>
        <span>Rp. 46.500.000</span> <br>
        <small class="trend up">+Rp. 2.000.000</small>
    </div>

     
    <!-- <div class="card">
        <div class="card-title">
            <i class="ph ph-chart-line-up"></i>
            <p>Arus Kas</p>
        </div>
        <span>Rp. 3.456.000</span> <br>
        <small class="trend down">-Rp. 500.000</small>
    </div> -->

    <div class="card">
        <div class="card-title">
            <i class="ph ph-credit-card"></i>
            <p>Total Angsuran</p>
        </div>
        <span>Rp. 12.750.000</span> <br>
        <small class="trend up">+Rp. 750.000</small>
    </div>

    <div class="card">
        <div class="card-title">
            <i class="ph ph-wallet"></i>
            <p>Saldo</p>
        </div>
        <span>Rp. 28.450.000</span> <br>
        <small class="trend up">+Rp. 1.000.000</small>
    </div>
</div>



<!-- <div class="card chart-wrapper">
    <h3>Aktivitas Mingguan</h3>
    <p class="chart-subtitle">Periode: 30 Juni – 6 Juli 2025</p>
    <div class="chart">
        <div class="bar-group">
            <div class="bar">
                <div class="bar-segment segment-1" style="height: 40%"><span class="bar-label">40%</span></div>
                <div class="bar-segment segment-2" style="height: 20%"><span class="bar-label">20%</span></div>
                <div class="bar-segment segment-3" style="height: 40%"><span class="bar-label">40%</span></div>
            </div>
            <p>Mon</p>
        </div>
        <div class="bar-group">
            <div class="bar">
                <div class="bar-segment segment-1" style="height: 50%"><span class="bar-label">50%</span></div>
                <div class="bar-segment segment-2" style="height: 30%"><span class="bar-label">30%</span></div>
                <div class="bar-segment segment-3" style="height: 20%"><span class="bar-label">20%</span></div>
            </div>
            <p>Tue</p>
        </div>
        <div class="bar-group">
            <div class="bar">
                <div class="bar-segment segment-1" style="height: 35%"><span class="bar-label">35%</span></div>
                <div class="bar-segment segment-2" style="height: 25%"><span class="bar-label">25%</span></div>
                <div class="bar-segment segment-3" style="height: 40%"><span class="bar-label">40%</span></div>
            </div>
            <p>Wed</p>
        </div>
        <div class="bar-group">
            <div class="bar">
                <div class="bar-segment segment-1" style="height: 45%"><span class="bar-label">45%</span></div>
                <div class="bar-segment segment-2" style="height: 25%"><span class="bar-label">25%</span></div>
                <div class="bar-segment segment-3" style="height: 30%"><span class="bar-label">30%</span></div>
            </div>
            <p>Thu</p>
        </div>
        <div class="bar-group">
            <div class="bar">
                <div class="bar-segment segment-1" style="height: 60%"><span class="bar-label">60%</span></div>
                <div class="bar-segment segment-2" style="height: 25%"><span class="bar-label">25%</span></div>
                <div class="bar-segment segment-3" style="height: 15%"><span class="bar-label">15%</span></div>
            </div>
            <p>Fri</p>
        </div>
        <div class="bar-group">
            <div class="bar">
                <div class="bar-segment segment-1" style="height: 25%"><span class="bar-label">25%</span></div>
                <div class="bar-segment segment-2" style="height: 15%"><span class="bar-label">15%</span></div>
                <div class="bar-segment segment-3" style="height: 60%"><span class="bar-label">60%</span></div>
            </div>
            <p>Sat</p>
        </div>
        <div class="bar-group">
            <div class="bar">
                <div class="bar-segment segment-1" style="height: 35%"><span class="bar-label">35%</span></div>
                <div class="bar-segment segment-2" style="height: 25%"><span class="bar-label">25%</span></div>
                <div class="bar-segment segment-3" style="height: 40%"><span class="bar-label">40%</span></div>
            </div>
            <p>Sun</p>
        </div>
    </div> 

    <div class="chart-legend">
        <span><span class="legend-box segment-1"></span> Simpanan</span>
        <span><span class="legend-box segment-2"></span> Pinjaman</span>
        <span><span class="legend-box segment-3"></span> Angsuran</span>
    </div>
</div> --> 
@endsection
