<!-- Left column -->
           <div class="list-group">
              <a href="{{ route('trans.start') }}" class="list-group-item">
                <h4 class="list-group-item-heading"><i class="glyphicon glyphicon-duplicate"></i> Transaksi Baru</h4>
              </a>
            </div>

            <hr>

            <a href="#"><strong><i class="glyphicon glyphicon-link"></i> Master</strong></a>

            <hr>

            <ul class="nav nav-pills nav-stacked">
                <li class="nav-header"></li>
                @if (isset($roleAlias) && $roleAlias === "sv")
                  <li class="{{ (isset($active) && $active === 'mtbarang') ? "active" : null }}">
                    <a href="{{ route('tempitems.index') }}"><i class="glyphicon glyphicon-briefcase"></i> Master Template Barang</a></li>
                  <li class="{{ (isset($active) && $active === 'mkamar') ? "active" : null }}">
                    <a href="{{ route('rooms.index') }}"><i class="glyphicon glyphicon-list-alt"></i> Master Kamar</a></li>
                  <li class="{{ (isset($active) && $active === 'mconsultant') ? "active" : null }}">
                    <a href="{{ route('consultants.index') }} "><i class="glyphicon glyphicon-star"></i> Master Konsultant</a></li>
                  <li class="{{ (isset($active) && $active === 'mpengguna') ? "active" : null }}">
                    <a href="{{ route('users.index') }}"><i class="glyphicon glyphicon-user"></i> Master Pengguna</a></li>
                @endif
                <li class="{{ (isset($active) && $active === 'mtransmaster') ? "active" : null }}" >
                  <a href="{{ route('trans.index') }}"><i class="glyphicon glyphicon-list-alt"></i> Master Transaksi</a></li>
                <li class="{{ (isset($active) && $active === 'mbarang') ? "active" : null }}">
                  <a href="{{ route('items.index') }}"><i class="glyphicon glyphicon-briefcase"></i> Master Barang</a></li>
                <li class="{{ (isset($active) && $active === 'mjasa') ? "active" : null }}">
                  <a href="{{ route('services.index')}}"><i class="glyphicon glyphicon-link"></i> Master Jasa</a></li>
                <li class="{{ (isset($active) && $active === 'mpasien') ? "active" : null }}">
                  <a href="{{ route('patients.index') }}"><i class="glyphicon glyphicon-book"></i> Master Pasien</a></li>
            </ul>

            <hr>
