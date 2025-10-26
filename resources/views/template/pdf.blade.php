<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Relatório de Tickets</title>
  <style>

@page {
    margin: 80px 40px;
  }

  header {
    position: fixed;
    top: -60px;
    left: 0;
    right: 0;
    height: 50px;
    text-align: left;
    line-height: 35px;
    font-weight: bold;
  }

  footer {
    position: fixed;
    bottom: -40px;
    left: 0;
    right: 0;
    height: 30px;
    font-size: 12px;
    color: #555;
    text-align: right;
  }

  /* Contador de páginas automático */
  footer .page-number:after {
    content: counter(page);
  }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      color: #333;
    }

    h1 {
      margin: 0;
      font-size: 26px;
      color: #1e293b;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 10px;
    }

    .title-logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo {
      width: 40px;
      height: auto;
    }

    .header p {
      margin: 2px 0;
      font-size: 13px;
      color: #555;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 10px;
      overflow: hidden;
      border-color: red;
    }

    th, td {
      text-align: left;
      padding: 5px 6px;
      font-size: 13px;
    }

    th {
      background-color: #2563eb;
      color: white;
      border-bottom: 2px solid #1e40af;
      text-align: center;
      font-family: Arial, Helvetica, sans-serif;
    }

    td {
      border-bottom: 1px solid #e2e8f0;
    }

    tr:nth-child(even) td {
      background-color: #ececec;
    }

    .footer {
      margin-top: 20px;
      font-size: 13px;
      color: #475569;
    }

    .status-0 { color: #ea0808; font-weight: bold; }
    .status-1 { color: #f68f3b; font-weight: bold; }
    .status-2 { color: #16a34a; font-weight: bold; }
    .status-3 { color: #a31616; font-weight: bold; }
    .status-4 { color: #164ea3; font-weight: bold; }
    .status-5 { color: #a31616; font-weight: bold; }
    .status-6 { color: #1637a3; font-weight: bold; }

    .box-filter{
      margin-bottom: 8px;
      background-color: rgb(235, 235, 235);
      border-radius: 5px;
      padding: 8px;
    }

    @media print {
      body { background: white; }
      .card, .filter-box { box-shadow: none; }
      table { box-shadow: none; }
    }
  </style>
</head>
<body>

  <header>
    Relatório de Chamados - Evogard
  </header>

  <footer>
    Página <span class="page-number"></span>
  </footer>

  <main>

    <div class="box-filter">

      <label><strong>Total encontrado:</strong> {{$sum}} ticket(s).</label> <br>
      <label><strong>Período selecionado:</strong> {{$start}} a {{$end}}</label>

    </div>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Departamento</th>
        <th>Solicitação</th>
        <th>Solicitante</th>
        
        <th>Prioridade</th>
        <th>Status</th>
        <th>Abertura</th>
        <th>Fechamento</th>
        <th>Responsável</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($result as $ticket)

        @php
          $labelStatus = match ($ticket->status_chamados) {
              0 => ["status-0", "Aberto"],
              1 => ["status-1", "Encaminhado"],
              2 => ["status-2", "Execução"],
              3 => ["status-3", "Pendente"],
              4 => ["status-4", "Resolvido"],
              5 => ["status-5", "Não Resolvido"],
              6 => ["status-6", "Sem Retorno"],
          };

          $labelPrioridade = match ($ticket->solicitacao->prioridade_solicitacoes) {
              "1" => "Baixa",
              "2" => "Normal",
              "3" => "Alta",
              default => "---"
          };
        @endphp

        <tr>
          <td>{{$ticket->id_chamados}}</td>
          <td>{{$ticket->departamento->nome_departamentos}}</td>
          <td>{{$ticket->solicitacao->titulo_solicitacoes}}</td>
          <td>{{$ticket->nome_criador_chamados}}</td>
          <td>{{$labelPrioridade}}</td>
          <td class="{{$labelStatus[0]}}">{{$labelStatus[1]}}</td>
          <td>{{$ticket->data_cadastro_chamados}}</td>
          <td>{{$ticket->data_finalizar_chamados ?? '---'}}</td>
          <td>{{$ticket->user?->name ?? '---'}}</td>
        </tr>
        
      @endforeach

      
    </tbody>
  </table>
  </main>

  
</body>
</html>
