export const calcDifHouUtils = (di, df) => {

    const d1 = new Date(di).getTime()
    const d2 = new Date(df).getTime()

    const temp = (d2 - d1) / 3600000

    return temp

}