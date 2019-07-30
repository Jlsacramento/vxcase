<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venda;
use App\VendasProduto;
use DB;
use Redirect;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sales = Venda::all();

        return view('vendas', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            DB::beginTransaction();

            $sale = new Venda;

            $caracteresEspeciais = array("R$ ", ",00");

            for ($i=0; $i < count($request->pro_preco); $i++) { 
                $novoPreco[$i] = str_replace($caracteresEspeciais, "", $request->pro_preco[$i]);;
            }

            $precoTotal = 0;
            for ($i=0; $i < count($novoPreco); $i++) { 
                $precoTotal += $novoPreco[$i];
            }

            $sale->ven_total = $precoTotal;

            $sale->save();

            $saleProducts = new VendasProduto;

            for ($i=0; $i < count($request->pro_id); $i++) { 
                $saleProducts = VendasProduto::create([
                    'ven_id' => $sale->ven_id,
                    'pro_id' => $request->pro_id[$i],
                    'pro_preco' => $novoPreco[$i],
                ]);
            }

            if(isset($sale) && isset($saleProducts)) {
                DB::commit();
                \Session::flash('mensagem_sucesso', 'Venda realizada com sucesso!');
                
                return Redirect::to('vendas');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            /* return redirect('/caixa')->with('error', 'Erro ao realizar a venda!'); */
            \Session::flash('error', 'Erro ao realizar a venda!');
            
            return Redirect::to('caixa');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $sale = Venda::find($id);

        if($sale) {
            $saleProducts = DB::table('vendas')
                ->leftJoin('vendas_produtos', 'vendas.ven_id', '=', 'vendas_produtos.ven_id')
                ->leftJoin('produtos', 'vendas_produtos.pro_id', '=', 'produtos.pro_id')
                ->where('vendas.ven_id', $id)
                ->select('produtos.pro_id', 'produtos.pro_nome', 'vendas_produtos.pro_preco', 'produtos.pro_entrega')
                ->get();
        }

        $entrega = DB::table('vendas')
                    ->leftJoin('vendas_produtos', 'vendas.ven_id', '=', 'vendas_produtos.ven_id')
                    ->leftJoin('produtos', 'vendas_produtos.pro_id', '=', 'produtos.pro_id')
                    ->where('vendas.ven_id', $id)
                    ->max('produtos.pro_entrega');

        $entrega = date('d/m/y', strtotime('+'.$entrega. ' days'));
                
        /* echo '<pre>';
        var_dump($entrega);
        die(); */

        $saleProducts = json_decode($saleProducts, true);
        
        return view('venda', compact('sale', 'saleProducts', 'entrega'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
