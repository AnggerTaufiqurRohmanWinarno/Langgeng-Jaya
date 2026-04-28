from flask import Flask, request, jsonify
import pandas as pd
from sklearn.cluster import KMeans
import numpy as np

app = Flask(__name__)

# =====================
# LOAD DATA
# =====================
data = pd.read_csv("dataset_penjualan_rongsok_update_v2.csv", sep=";")

model = {}

for barang in data["barang"].unique():
    subset = data[data["barang"] == barang]["berat_keluar_kg"].values.reshape(-1,1)

    kmeans = KMeans(n_clusters=2, random_state=42)
    kmeans.fit(subset)

    centers = kmeans.cluster_centers_.flatten()
    cluster_jual = np.argmax(centers)

    model[barang] = {
        "kmeans": kmeans,
        "cluster_jual": cluster_jual
    }

def prediksi_jual(barang, stok):
    if barang not in model:
        return "DATA TIDAK ADA"

    kmeans = model[barang]["kmeans"]
    cluster_jual = model[barang]["cluster_jual"]

    pred_cluster = kmeans.predict([[stok]])[0]

    return "JUAL" if pred_cluster == cluster_jual else "TUNGGU"

@app.route('/prediksi', methods=['POST'])
def prediksi():
    req = request.json

    barang = req.get('barang')
    stok = req.get('stok')

    hasil = prediksi_jual(barang, stok)

    return jsonify({
        "barang": barang,
        "stok": stok,
        "rekomendasi": hasil
    })

if __name__ == '__main__':
    app.run(debug=True)