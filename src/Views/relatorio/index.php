<div class="box-12 flex justify-center pd-t-4">

   <form action="/relatorios/gerar" method="GET" class="box-6">

      <div class="box-12">
         <h1 class="fonte22 txt-c">Relatórios</h1>
      </div>

      <div class="box-12">
         <div class="box-12">
            <h3 class="fonte16 fw-400 mg-t-3 "> Escolha o período</h3>
            <div class=" divider mg-b-2"></div>
         </div>
         <div class="box-6">
            <label for="">Data Inicio</label>
            <input type="date" name="inicio">
         </div>

         <div class="box-6">
            <label for="">Data Fim</label>
            <input type="date" name="fim">
         </div>

      </div>
      <div class="box-12">

         <select name="tipo" id="">
             <option value="">Escolha o relatório...</option>
             <option value="vendas-periodo"> Venda Por Período </option>
             <option value="vendas-produto"> Vendas por Produto </option>
         </select>
      </div>

      <div class="box-12">
         <input type="submit" value="Gerar Relatótio" class="btn-100 bg-primario fnc-branco mg-t-2">
      </div>

   </form>

</div>