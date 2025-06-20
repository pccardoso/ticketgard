import axios from "axios";

export const calcDifHouUtils = (di, df) => {

    const d1 = new Date(di).getTime()
    const d2 = new Date(df).getTime()

    const temp = (d2 - d1) / 3600000

    return temp

}

export const getTimeCurrentUtils = () => {
    
    const agora = new Date();

    const horas = String(agora.getHours()).padStart(2, '0');
    const minutos = String(agora.getMinutes()).padStart(2, '0');
    const segundos = String(agora.getSeconds()).padStart(2, '0');

    return `${horas}:${minutos}:${segundos}`;
}

export const sendEmail = (data) => {

    axios.post('https://webhook.mundoevogard.com/webhook/notificacaoticketgard', data);

}

export const validateForm = (data, attributes, labels) => {
  let fieldsErros = {};
  let index = 0
  for (let attr of attributes) {
    !data[attr] || !data[attr][0] ? fieldsErros[attr] = "Preencha " + labels[index] : '';
    index++;
  }
  return fieldsErros;
}