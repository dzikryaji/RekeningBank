const saldoColumn = document.querySelectorAll(".saldo");

function formatRupiah (saldo){
    let formattedSaldo = Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    })
    
    return formattedSaldo.format(saldo);
}

for (let index = 0; index < saldoColumn.length; index++) {
    nominal = Number(saldoColumn[index].textContent);
    saldoColumn[index].textContent = formatRupiah(nominal);  
}
