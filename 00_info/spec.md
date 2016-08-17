## Automatencontroller

- Mini "UI" (Konsole OK),  "gib mir mate button"
- Soll die beiden anderen APIs ansprechen
- Soll fortlaufend den Status anzeigen

## Geldannahme

- Münzenvorrat verwalten
- Buttons für "Münzeingabe"
- POST http://geldannahme/transaction
    - req: { }
    - Response
        - 200 OK
        - { status: ok, transaction-id: xyzzy }
- POST http://geldannahme/transaction/xyzzy/charge-money
     - req: { "amount": 2.50, "currency": "EUR" }
     - Response
         - 200 OK
         - { status: ok, }
- GET http://geldannahme/transaction/xyzzy/amount-paid  
     - res: { amount: 1.00, currency: EUR }
- GET http://geldannahme/transaction/xyzzy/status
     - 200 OK
     - 409 Conflict
	     - res: { "status": "not enough change" }
- POST http://geldannahme/transaction/xyzzy/rollback
     - Geldrückgabe
     - 200 OK
- POST http://geldannahme/transaction/xyzzy/commit
     - Wechselgeld auszahlen
     - 200 OK


## Mateausgabe

- Bestand verwalten
- POST http://Mateausgabe/transaction
     - req: { }
     - Response
	     - 200 OK
	     - { status: ok, transaction-id: xyzzy }
- POST http://Mateausgabe/transaction/xyzzy/prepare-supply 
      - req: { "good": "mate", "quantity": 2 }
      - 200 OK
     - 409 Conflict
- GET http://Mateausgabe/transaction/xyzzy/status
     - 200 OK
     - 409 Conflict
	     - res: { "status": "not enough mate" }
- POST http://Mateausgabe/transaction/xyzzy/rollback
     - revert auf Zustand vor Transaction
     - 200 OK
- POST http://Mateausgabe/transaction/xyzzy/commit
     - Mate ausgeben
     - 200 OK
