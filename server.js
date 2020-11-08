const sqlite3 = require('sqlite3').verbose();

let db = new sqlite3.Database('./database/CHOPPEE.db',(err)=>{

    if(err){
        console.log(err.message)
    }
    console.log('connected to CHOPPEE db in sqlite')

    db.close((err)=>{
        if(err){
            console.log(err.message)
        }
    })
    console.log('CHOPPEE db is closed')
});