import json
import sys
from datetime import datetime

def main():
    # Contoh data yang diambil/diproses lewat Python
    data = {
        "status": "success",
        "message": "Data ini diambil dengan mengeksekusi script Python langsung dari Laravel!",
        "timestamp": datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
        "items": [
            {"id": 1, "name": "Analisis Sentimen", "value": "Positif"},
            {"id": 2, "name": "Prediksi Market", "value": "Bullish"},
            {"id": 3, "name": "Rekomendasi", "value": "Buy"}
        ],
        "python_version": sys.version
    }
    
    # Outputkan sebagai JSON agar mudah diparsing oleh PHP
    print(json.dumps(data))

if __name__ == "__main__":
    main()
