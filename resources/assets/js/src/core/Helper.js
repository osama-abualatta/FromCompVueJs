export default class Helper{
    static isEmpty(value){
if (Helper.isobject(value)){
    return Object.keys(value).length===0;
}
return (
    value===undefined ||
    value===null ||
    value.length===0
);
    }
    static isobject(value){
return value instanceof Object && !Array.isArray(value);
    }
}
