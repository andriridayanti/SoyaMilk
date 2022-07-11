<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Keuangan;
use App\Models\Mitra;
use App\Models\Ongkir;
use App\Models\Pemesanan;
use App\Models\Produk;
use App\Models\UlasanProduk;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Whoops\Run;

class MasterController extends Controller
{
    public function Landing()
    {
        return view('Landing');
    }
    public function Registrasi()
    {
        if (Session::has('Login')) {
            return redirect()->route('Beranda');
        }
        return view('Registrasi');
    }
    public function AuthRegistrasi(Request $req)
    {
        $userid = User::select('id')->orderBy('id', 'desc')->first();
        $userid = $userid['id'] + 1;
        $Mitra = DB::table('mitra')->where('email', $req->email)->count();
        $Customer = DB::table('customer')->where('email', $req->email)->count();
        if ($Mitra == 0 && $Customer == 0) {
            DB::table('users')->insert([
                'name' => $req->nama,
                'email' => $req->email,
                'password' => $req->password,
                'role' => 'customer'
            ]);

            DB::table('customer')->insert([
                'user_id' => $userid,
                'nama' => $req->nama,
                'email' => $req->email,
                'password' => $req->password,
                'no_telp' => $req->noTelp,
                'alamat' => $req->alamat,
                'desa' => $req->desa,
                'kecamatan' => $req->kecamatan,
                'jenis_kelamin' => $req->kelamin
            ]);
            Session::flash('alertSuccess', 'Registrasi Berhasil');
            return back();
        } else {
            Session::flash('alertError', 'Email Telah Digunakan');
            return back();
        }
    }
    public function Login()
    {
        if (Session::has('Login')) {
            return redirect()->route('Beranda');
        }
        return view('Login');
    }
    public function AuthLogin(Request $req)
    {
        $Customer = DB::table('customer')->where('email', $req->email);
        $Mitra = DB::table('mitra')->where('email', $req->email);
        if ($Customer->count() == 1) {
            if ($Customer->first()->password == $req->password) {
                Session::put('Login', TRUE);
                Session::put('Id', $Customer->first()->id);
                Session::put('Email', $req->email);
                Session::put('Level', 'Customer');
                return redirect()->route('Beranda');
            } else {
                Session::flash('alertError', 'Username atau Password salah!');
                return back();
            }
        } elseif ($Mitra->count() == 1) {
            if ($Mitra->first()->password == $req->password) {
                Session::put('Login', TRUE);
                Session::put('Email', $req->email);
                Session::put('Level', 'Mitra');
                return redirect()->route('Beranda');
            } else {
                Session::flash('alertError', 'Username atau Password salah!');
                return back();
            }
        } else {
            Session::flash('alertError', 'Username Belum Terdaftar');
            return back();
        }
    }
    public function Logout()
    {
        Session::forget('Login');
        Session::forget('Email');
        Session::forget('Level');
        return redirect()->route('Login');
    }
    public function Beranda()
    {
        $Artikel = DB::table('artikel')->get();
        return view('Beranda', compact('Artikel'));
    }
    public function BiodataDiri()
    {
        if (Session::get('Level') == 'Mitra') {
            $Biodata = DB::table('mitra')->where('email', Session::get('Email'))->first();
        } else {
            $Biodata = DB::table('customer')->where('email', Session::get('Email'))->first();
        }
        return view('BiodataDiri', compact('Biodata'));
    }
    public function AuthBiodataDiri(Request $req)
    {
        if (Session::get('Level') == 'Mitra') {
            $Biodata = DB::table('mitra')->where('email', Session::get('Email'));
            $Biodata2 = DB::table('users')->where('email', Session::get('Email'));
        } else {
            $Biodata = DB::table('customer')->where('email', Session::get('Email'));
            $Biodata2 = DB::table('users')->where('email', Session::get('Email'));
        }
        $Biodata2->update([
            'name' => $req->nama,
            'email' => $req->email,
            'password' => $req->password
        ]);
        $Biodata->update([
            'nama' => $req->nama,
            'password' => $req->password,
            'no_telp' => $req->noTelp,
            'alamat' => $req->alamat,
            'desa' => $req->desa,
            'kecamatan' => $req->kecamatan,
            'jenis_kelamin' => $req->kelamin
        ]);
        Session::flash('alertSuccess', 'Biodata Diri Berhasil Diubah');
        return back();
    }
    public function BiodataMitra()
    {
        $Biodata = DB::table('mitra')->first();
        return view('BiodataMitra', compact('Biodata'));
    }
    public function AkunCustomer()
    {
        $Customer = DB::table('customer')->get();
        return view('AkunCustomer', compact('Customer'));
    }
    public function BiodataCustomer($id)
    {
        $Biodata = DB::table('customer')->where('id', $id)->first();
        return view('BiodataCustomer', compact('Biodata'));
    }
    public function LihatArtikel($id)
    {
        $Artikel = DB::table('artikel')->where('id', $id)->first();
        return view('LihatArtikel', compact('Artikel'));
    }
    public function TambahArtikel()
    {
        return view('TambahArtikel');
    }
    public function AuthTambahArtikel(Request $req)
    {
        $NamaFile = time() . '.' . $req->file->getClientOriginalExtension();
        $req->file->move('../public/artikel', $NamaFile);
        DB::table('artikel')->insert([
            'judul' => $req->judul,
            'penulis' => $req->penulis,
            'penerbit' => $req->penerbit,
            'isi' => $req->isi,
            'gambar' => $NamaFile,
            'mitra_id' => 1
        ]);
        Session::flash('alertSuccess', 'Artikel Berhasil Ditambah');
        return back();
    }
    public function EditArtikel($id)
    {
        $Artikel = DB::table('artikel')->where('id', $id)->first();
        return view('EditArtikel', compact('Artikel'));
    }
    public function AuthEditArtikel(Request $req)
    {
        DB::table('artikel')->where('id', $req->id)->update([
            'judul' => $req->judul,
            'penulis' => $req->penulis,
            'penerbit' => $req->penerbit,
            'isi' => $req->isi
        ]);
        Session::flash('alertSuccess', 'Artikel Berhasil Diubah');
        return back();
    }
    public function HapusArtikel($id)
    {
        $Data = DB::table('artikel')->where('id', $id);
        unlink('artikel/' . $Data->first()->gambar);
        $Data->delete();
        Session::flash('alertSuccess', 'Artikel Berhasil Dihapus');
        return back();
    }

    public function Produk()
    {
        $Produk = DB::table('produk')->get();
        return view('Produk', compact('Produk'));
    }

    public function TambahProduk()
    {
        return view('TambahProduk');
    }

    public function AuthTambahProduk(Request $req)
    {
        $NamaFile = time() . '.' . $req->file->getClientOriginalExtension();
        $req->file->move('../public/foot-produk', $NamaFile);
        DB::table('produk')->insert([
            'nama_produk' => $req->nama_produk,
            'harga' => $req->harga,
            'stok' => $req->stok,
            'berat' => $req->berat,
            'gambar' => $NamaFile,
            'mitra_id' => 1
        ]);
        Session::flash('alertSuccess', 'Produk Berhasil Ditambah');
        return back();
    }

    public function LihatProduk($id)
    {
        if (Session::get('Level') == 'Customer') {
            $data = DB::table('customer')->where('email', Session::get('Email'))->first();
        } else {
            $data = DB::table('mitra')->where('email', Session::get('Email'))->first();
        }
        $Ongkir = Db::table('ongkir')->join('kecamatan', 'ongkir.kecamatan_id', '=', 'kecamatan.id')->select('kecamatan.kecamatan', 'ongkir.id', 'ongkir.harga_ongkir')->get();
        $Produk = DB::table('produk')->where('id', $id)->first();
        return view('LihatProduk', compact('Produk', 'data', 'Ongkir'));
    }

    public function EditProduk($id)
    {
        $Produk = DB::table('produk')->where('id', $id)->first();
        return view('EditProduk', compact('Produk'));
    }

    public function AuthEditProduk(Request $req)
    {
        DB::table('produk')->where('id', $req->id)->update([
            'nama_produk' => $req->nama_produk,
            'harga' => $req->harga,
            'berat' => $req->berat,
            'stok' => $req->stok
        ]);
        Session::flash('alertSuccess', 'Produk Berhasil Diubah');
        return back();
    }
    public function HapusProduk($id)
    {
        $Data = DB::table('produk')->where('id', $id);
        unlink('foto-produk/' . $Data->first()->gambar);
        $Data->delete();
        Session::flash('alertSuccess', 'Produk Berhasil Dihapus');
        return back();
    }

    public function AuthPemesananProduk(Request $req, $id)
    {
        $data = Produk::select('harga')->where('id', $id)->first();
        $data = $data['harga'];
        $harga = intval($data);
        Pemesanan::create([
            'produk_id' => $req->produk_id,
            'customer_id' => $req->customer_id,
            'ongkir_id' => $req->ongkir_id,
            'harga' => $harga,
            'jumlah_transaksi' => $req->jumlah_pembelian,
            'total_pembayaran' => intval($req->jumlah_pembelian) * $harga,
            'metode_pembayaran' => $req->metode_pembayaran,
            'tanggal_pengantaran' => $req->tanggal_pengantaran,
            'catatan' => $req->catatan,
            'status' => $req->status
        ]);

        $ongkir = Pemesanan::select('id', 'ongkir_id')->orderBy('id', 'desc')->first();
        $ongkirid = $ongkir['ongkir_id'];

        $harga_ongkir = Ongkir::select('id', 'harga_ongkir')->where('id', $ongkirid)->first();
        $total_ongkir = $harga_ongkir['harga_ongkir'];

        $pemesananproduk = Pemesanan::select('id')->orderBy('id', 'desc')->first();
        $pemesananprodukid = $pemesananproduk['id'];
        Keuangan::create([
            'pemesanan_produk_id' => $pemesananprodukid,
            'keterangan' => 'masuk',
            'transaksi' => 'Penjualan',
            'jumlah_transaksi' => $req->jumlah_pembelian,
            'harga_satuan' => $harga,
            'total_transaksi' => (intval($req->jumlah_pembelian) * $harga) + intval($total_ongkir)
        ]);
        $stok = Produk::select('id', 'stok')->where('id', $id)->first();
        $datastok = $stok['stok'];
        DB::table('produk')->where('id', $id)->update([
            'stok' => intval($datastok) - intval($req->jumlah_pembelian)
        ]);
        Session::flash('alertSuccess', 'Pemesanan Berhasil Dibuat');
        return back();
    }

    public function Pemesanan(Request $req)
    {
        if (Session::get('Level') == 'Mitra') {
            $data = DB::table('mitra')->where('email', Session::get('Email'))->first();
            if ($req->has('search')) {
                $Pemesanan = DB::table('pemesanan_produk')->join('customer', 'pemesanan_produk.customer_id', '=', 'customer.id')->join('produk', 'pemesanan_produk.produk_id', '=', 'produk.id')->select('customer.nama', 'customer.no_telp', 'customer.alamat', 'produk.nama_produk', 'produk.harga', 'produk.berat', 'produk.gambar', 'pemesanan_produk.id', 'pemesanan_produk.produk_id', 'pemesanan_produk.customer_id', 'pemesanan_produk.total_pembayaran', 'pemesanan_produk.metode_pembayaran', 'pemesanan_produk.tanggal_pengantaran', 'pemesanan_produk.customer_id', 'pemesanan_produk.status')->where('customer.nama', 'LIKE', '%' . $req->search . '%')->get();
            } else {
                $Pemesanan = DB::table('pemesanan_produk')->join('customer', 'pemesanan_produk.customer_id', '=', 'customer.id')->join('produk', 'pemesanan_produk.produk_id', '=', 'produk.id')->select('customer.nama', 'customer.no_telp', 'customer.alamat', 'produk.nama_produk', 'produk.harga', 'produk.berat', 'produk.gambar', 'pemesanan_produk.id', 'pemesanan_produk.produk_id', 'pemesanan_produk.customer_id', 'pemesanan_produk.total_pembayaran', 'pemesanan_produk.metode_pembayaran', 'pemesanan_produk.tanggal_pengantaran', 'pemesanan_produk.customer_id', 'pemesanan_produk.status')->get();
            }
            return view('Pemesanan', compact('Pemesanan'));
        } else {
            $data = DB::table('customer')->where('email', Session::get('Email'))->first();
            $Pemesanan = DB::table('pemesanan_produk')->join('customer', 'pemesanan_produk.customer_id', '=', 'customer.id')->join('produk', 'pemesanan_produk.produk_id', '=', 'produk.id')->select('customer.nama', 'customer.no_telp', 'customer.alamat', 'produk.nama_produk', 'pemesanan_produk.harga', 'produk.berat', 'produk.gambar', 'pemesanan_produk.id', 'pemesanan_produk.produk_id', 'pemesanan_produk.customer_id', 'pemesanan_produk.total_pembayaran', 'pemesanan_produk.metode_pembayaran', 'pemesanan_produk.tanggal_pengantaran', 'pemesanan_produk.status')->where('pemesanan_produk.customer_id', $data->id)->get();

            $auth = DB::table('pemesanan_produk')->join('customer', 'pemesanan_produk.customer_id', '=', 'customer.id')->join('produk', 'pemesanan_produk.produk_id', '=', 'produk.id')->select('customer.nama', 'customer.no_telp', 'customer.alamat', 'produk.nama_produk', 'produk.harga', 'produk.berat', 'produk.gambar', 'pemesanan_produk.id', 'pemesanan_produk.produk_id', 'pemesanan_produk.customer_id', 'pemesanan_produk.total_pembayaran', 'pemesanan_produk.metode_pembayaran', 'pemesanan_produk.tanggal_pengantaran', 'pemesanan_produk.status')->where('pemesanan_produk.customer_id', $data->id)->first();
            if (isset($auth)) {
                return view('PemesananCustomer', compact('Pemesanan'));
            } else {
                Session::flash('alertError', 'Anda masih belum memiliki Riwayat Pemesanan!');
                return back();
            }
        }
    }

    public function SearchPemesanan(Request $req)
    {
        $dari = $req->dari;
        $sampai = $req->sampai;

        $Pemesanan = DB::table('pemesanan_produk')->join('customer', 'pemesanan_produk.customer_id', '=', 'customer.id')->join('produk', 'pemesanan_produk.produk_id', '=', 'produk.id')->select('customer.nama', 'customer.no_telp', 'customer.alamat', 'produk.nama_produk', 'produk.harga', 'produk.berat', 'produk.gambar', 'pemesanan_produk.id', 'pemesanan_produk.produk_id', 'pemesanan_produk.customer_id', 'pemesanan_produk.total_pembayaran', 'pemesanan_produk.metode_pembayaran', 'pemesanan_produk.tanggal_pengantaran', 'pemesanan_produk.customer_id', 'pemesanan_produk.status')->where([['tanggal_pengantaran', '>=', $dari], ['tanggal_pengantaran', '<=', $sampai]])->get();
        $data = DB::table('pemesanan_produk')->join('customer', 'pemesanan_produk.customer_id', '=', 'customer.id')->join('produk', 'pemesanan_produk.produk_id', '=', 'produk.id')->select('customer.nama', 'customer.no_telp', 'customer.alamat', 'produk.nama_produk', 'produk.harga', 'produk.berat', 'produk.gambar', 'pemesanan_produk.id', 'pemesanan_produk.produk_id', 'pemesanan_produk.customer_id', 'pemesanan_produk.total_pembayaran', 'pemesanan_produk.metode_pembayaran', 'pemesanan_produk.tanggal_pengantaran', 'pemesanan_produk.customer_id', 'pemesanan_produk.status')->where([['tanggal_pengantaran', '>=', $dari], ['tanggal_pengantaran', '<=', $sampai]])->first();

        if (isset($data)) {
            return view('Pemesanan', compact('dari', 'sampai', 'Pemesanan'));
        } else {
            Session::flash('alertError', 'Data pencarian tidak ditemukan!');
            return back();
        }
    }

    public function DetailPemesanan($id)
    {
        $Pemesanan = DB::table('pemesanan_produk')->join('customer', 'pemesanan_produk.customer_id', '=', 'customer.id')->join('produk', 'pemesanan_produk.produk_id', '=', 'produk.id')->join('ongkir', 'pemesanan_produk.ongkir_id', '=', 'ongkir.id')->select('customer.nama', 'customer.no_telp', 'customer.alamat', 'produk.nama_produk', 'produk.harga', 'produk.berat', 'produk.gambar', 'pemesanan_produk.id', 'pemesanan_produk.produk_id', 'pemesanan_produk.customer_id', 'pemesanan_produk.total_pembayaran', 'pemesanan_produk.metode_pembayaran', 'pemesanan_produk.tanggal_pengantaran', 'pemesanan_produk.ongkir_id', 'ongkir.harga_ongkir', 'pemesanan_produk.jumlah_transaksi', 'pemesanan_produk.status')->where('pemesanan_produk.id', $id)->first();

        return view('DetailPemesanan', compact('Pemesanan'));
    }

    public function ProsesPengiriman()
    {
        DB::table('pemesanan_produk')->update([
            'status' => 'Dikirim'
        ]);
        Session::flash('alertSuccess', 'Pemesanan telah dikirim!');
        return back();
    }

    public function KonfirmasiPengiriman()
    {
        DB::table('pemesanan_produk')->update([
            'status' => 'Diterima'
        ]);
        Session::flash('alertSuccess', 'Pemesanan telah dikonfirmasi!');
        return back();
    }

    public function UlasanProduk($id)
    {
        $Produk = Produk::where('id', $id)->first();
        if (Session::get('Level') == 'Customer') {
            $data = DB::table('customer')->where('email', Session::get('Email'))->first();
            $Ulasan = UlasanProduk::join('produk', 'ulasan_produk.produk_id', '=', 'produk.id')->join('customer', 'ulasan_produk.customer_id', '=', 'customer.id')->select('ulasan_produk.produk_id', 'ulasan_produk.customer_id', 'ulasan_produk.deskripsi', 'ulasan_produk.gambar', 'produk.nama_produk', 'produk.harga', 'produk.berat', 'produk.gambar', 'customer.nama', 'ulasan_produk.id')->where('ulasan_produk.produk_id', $id)->get();

            $bolehUlas = Pemesanan::where([['customer_id', $data->id], ['produk_id', $id]])->first();
            return view('UlasanProduk', compact('Produk', 'Ulasan', 'data', 'bolehUlas'));
        } else {
            $Ulasan = UlasanProduk::join('produk', 'ulasan_produk.produk_id', '=', 'produk.id')->join('customer', 'ulasan_produk.customer_id', '=', 'customer.id')->select('ulasan_produk.produk_id', 'ulasan_produk.customer_id', 'ulasan_produk.deskripsi', 'ulasan_produk.gambar', 'produk.nama_produk', 'produk.harga', 'produk.berat', 'produk.gambar', 'customer.nama', 'ulasan_produk.id')->where('ulasan_produk.produk_id', $id)->get();

            return view('UlasanProdukAdmin', compact('Produk', 'Ulasan'));
        }
    }

    public function AuthUlasanProduk(Request $req, $id)
    {
        UlasanProduk::insert([
            'produk_id' => $req->produk_id,
            'customer_id' => $req->customer_id,
            'deskripsi' => $req->deskripsi
        ]);
        Session::flash('alertSuccess', 'Ulasan Berhasil Dibuat');
        return back();
    }

    public function HapusUlasan($id)
    {
        $Data = DB::table('ulasan_produk')->where('id', $id);
        $Data->delete();
        Session::flash('alertSuccess', 'Ulasan Berhasil Dihapus!');
        return back();
    }

    public function Keuangan()
    {
        $total_pendapatan = Keuangan::select(DB::raw("CAST(SUM(total_transaksi) as int) as total_pendapatan"))->where('keterangan', '=', 'masuk')->GroupBy(DB::raw("Month(created_at)"))->pluck('total_pendapatan');
        $total_pengeluaran = Keuangan::select(DB::raw("CAST(SUM(total_transaksi) as int) as total_pengeluaran"))->where('keterangan', '=', 'keluar')->GroupBy(DB::raw("Month(created_at)"))->pluck('total_pengeluaran');
        $bulan = Keuangan::select(DB::raw("MONTHNAME(created_at) as bulan"))->GroupBy(DB::raw("MONTHNAME(created_at)"))->pluck('bulan');
        $result = DB::select(DB::raw("select sum(total_transaksi) as transaksi, keterangan from keuangan group by keterangan"));
        $chartData = "";
        foreach ($result as $list) {
            $chartData .= "['" . $list->keterangan . "', " . $list->transaksi . "],";
        }
        $arr['chartData'] = rtrim($chartData, ",");

        return view('Keuangan', compact('total_pendapatan', 'total_pengeluaran', 'bulan', 'arr', 'chartData'));
    }

    public function TambahPengeluaran()
    {
        return view('TambahKeuangan');
    }

    public function AuthTambahKeuangan(Request $req)
    {
        Keuangan::create([
            'keterangan' => $req->keterangan,
            'transaksi' => $req->transaksi,
            'jumlah_transaksi' => $req->jumlah_transaksi,
            'harga_satuan' => $req->harga_satuan,
            'total_transaksi' => intval($req->jumlah_transaksi) * intval($req->harga_satuan)
        ]);
        Session::flash('alertSuccess', 'Data Pengeluaran Berhasil Ditambah!');
        return back();
    }

    public function Kecamatan()
    {
        $Kecamatan = Kecamatan::all();
        return view('Kecamatan', compact('Kecamatan'));
    }

    public function TambahKecamatan()
    {
        return view('TambahKecamatan');
    }

    public function AuthTambahKecamatan(Request $req)
    {
        Kecamatan::create([
            'kecamatan' => $req->kecamatan
        ]);
        Session::flash('alertSuccess', 'Data Kecamatan Berhasil Ditambah!');
        return back();
    }

    public function DetailKecamatan($id)
    {
        $Kecamatan = Kecamatan::where('id', $id)->first();
        return view('DetailKecamatan', compact('Kecamatan'));
    }

    public function AuthEditKecamatan(Request $req)
    {
        DB::table('kecamatan')->where('id', $req->id)->update([
            'kecamatan' => $req->kecamatan
        ]);
        Session::flash('alertSuccess', 'Kecamatan Berhasil Diubah');
        return back();
    }

    public function Ongkir()
    {
        $Ongkir = Ongkir::join('kecamatan', 'ongkir.kecamatan_id', '=', 'kecamatan.id')->select('kecamatan.kecamatan', 'ongkir.id', 'ongkir.harga_ongkir')->get();
        return view('Ongkir', compact('Ongkir'));
    }

    public function TambahOngkir()
    {
        $Kecamatan = Kecamatan::all();
        return view('TambahOngkir', compact('Kecamatan'));
    }

    public function AuthTambahOngkir(Request $req)
    {
        Ongkir::create([
            'kecamatan_id' => $req->kecamatan_id,
            'harga_ongkir' => $req->harga_ongkir
        ]);
        Session::flash('alertSuccess', 'Ongkos Kirim Berhasil Ditambah!');
        return back();
    }

    public function DetailOngkir($id)
    {
        $Kecamatan = Kecamatan::all();
        $Ongkir = Ongkir::select('id', 'kecamatan_id', 'harga_ongkir')->where('id', $id)->first();
        return view('DetailOngkir', compact('Ongkir', 'Kecamatan'));
    }

    public function AuthEditOngkir(Request $req)
    {
        DB::table('ongkir')->where('id', $req->id)->update([
            'kecamatan_id' => $req->kecamatan_id,
            'harga_ongkir' => $req->harga_ongkir
        ]);
        Session::flash('alertSuccess', 'Ongkos Kirim Berhasil Diubah!');
        return back();
    }

    public function Pendapatan(Request $req)
    {
        if ($req->has('search')) {
            $Pendapatan = Keuangan::join('pemesanan_produk', 'keuangan.pemesanan_produk_id', '=', 'pemesanan_produk.id')->join('produk', 'pemesanan_produk.produk_id', '=', 'produk.id')->join('ongkir', 'pemesanan_produk.ongkir_id', '=', 'ongkir.id')->select('produk.nama_produk', 'pemesanan_produk.created_at', 'keuangan.jumlah_transaksi', 'pemesanan_produk.total_pembayaran', 'keuangan.keterangan', 'keuangan.id', 'ongkir.harga_ongkir')->where([['keuangan.keterangan', '=', 'masuk'], ['produk.nama_produk', 'LIKE', '%' . $req->search . '%']])->get();
        } else {
            $Pendapatan = Keuangan::join('pemesanan_produk', 'keuangan.pemesanan_produk_id', '=', 'pemesanan_produk.id')->join('produk', 'pemesanan_produk.produk_id', '=', 'produk.id')->join('ongkir', 'pemesanan_produk.ongkir_id', '=', 'ongkir.id')->select('produk.nama_produk', 'pemesanan_produk.created_at', 'keuangan.jumlah_transaksi', 'pemesanan_produk.total_pembayaran', 'keuangan.keterangan', 'keuangan.id', 'ongkir.harga_ongkir')->where('keuangan.keterangan', '=', 'masuk')->get();
        }
        return view('Pendapatan', compact('Pendapatan'));
    }

    public function Pengeluaran(Request $req)
    {
        if ($req->has('search')) {
            $Pengeluaran = Keuangan::where([['keterangan', '=', 'keluar'], ['transaksi', 'LIKE', '%' . $req->search . '%']])->get();
        } else {
            $Pengeluaran = Keuangan::where('keterangan', '=', 'keluar')->get();
        }
        return view('Pengeluaran', compact('Pengeluaran'));
    }

    public function DetailPendapatan($id)
    {
        $Pendapatan = Keuangan::leftjoin('pemesanan_produk', 'keuangan.pemesanan_produk_id', '=', 'pemesanan_produk.id')->rightjoin('customer', 'pemesanan_produk.customer_id', '=', 'customer.id')->rightjoin('ongkir', 'pemesanan_produk.ongkir_id', '=', 'ongkir.id')->leftjoin('produk', 'pemesanan_produk.produk_id', '=', 'produk.id')->select('produk.nama_produk', 'produk.gambar', 'keuangan.jumlah_transaksi', 'pemesanan_produk.total_pembayaran', 'pemesanan_produk.tanggal_pengantaran', 'pemesanan_produk.metode_pembayaran', 'keuangan.id', 'customer.nama', 'customer.no_telp', 'customer.alamat', 'customer.desa', 'customer.kecamatan', 'produk.berat', 'produk.stok', 'pemesanan_produk.harga', 'ongkir.harga_ongkir')->where('keuangan.id', $id)->first();
        $harga = $Pendapatan['harga'];
        $jumlah = $Pendapatan['jumlah_transaksi'];
        $ongkir = $Pendapatan['harga_ongkir'];
        $total_pembayaran = (intval($harga) * intval($jumlah)) + intval($ongkir);
        return view('DetailPendapatan', compact('Pendapatan', 'total_pembayaran'));
    }

    public function DetailPengeluaran($id)
    {
        $Pengeluaran = Keuangan::where('id', $id)->first();
        return view('DetailPengeluaran', compact('Pengeluaran'));
    }

    public function AuthEditPengeluaran(Request $req)
    {
        DB::table('keuangan')->where('id', $req->id)->update([
            'transaksi' => $req->transaksi,
            'jumlah_transaksi' => $req->jumlah_transaksi,
            'harga_satuan' => $req->harga_satuan,
            'total_transaksi' => intval($req->harga_satuan) * intval($req->jumlah_transaksi),
        ]);
        Session::flash('alertSuccess', 'Pengeluaran Berhasil Diubah!');
        return back();
    }
}
