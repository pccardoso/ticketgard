
export const formatDateTexPtHelpers = (temp) => {

    const data = new Date(temp.replace(' ', 'T')); // Corrige para formato ISO

    const opcoes = {
        day: 'numeric',
        month: 'numeric',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
    };

    const dataFormatada = data.toLocaleString('pt-BR', opcoes);

    return dataFormatada
}

export const formatDateTextUsHelpers = ()=> {

    const agora = new Date();
    const ano = agora.getFullYear();
    const mes = String(agora.getMonth() + 1).padStart(2, '0');
    const dia = String(agora.getDate()).padStart(2, '0');
    const hora = String(agora.getHours()).padStart(2, '0');
    const minuto = String(agora.getMinutes()).padStart(2, '0');
    const segundo = String(agora.getSeconds()).padStart(2, '0');

    const dataHoraFormatada = `${ano}-${mes}-${dia} ${hora}:${minuto}:${segundo}`

    return dataHoraFormatada
    
}