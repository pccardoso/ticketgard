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

export const sendNotifyFirebase = (data) => {
    try{

      const response = axios.post("/send/notification", data);
      console.log(response);

    }catch(error){
      console.log(error);
    }
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

export const getUser = async (id) => {
  try{

    const response = await axios.get(`/con/user/${id}`);
    return response.data;

  }catch(error){
    console.log(`Erro na requisição: ${error}`);
  }
}

export const updateNotifyUser = async (payload) =>{
  try{
    
    const response = await axios.post("/upd/notify", payload);
    return response.data;

  }catch(error){
    console.log(`Erro na requisição: ${error}`);
  }
}