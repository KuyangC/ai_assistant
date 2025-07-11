from openai import OpenAI
from typing import List, Dict, Optional

class AIChatbot:
    def __init__(self, api_key: str, base_url: str = "https://openrouter.ai/api/v1", model: str = "openai/gpt-4o-mini"):
        self.client = OpenAI(base_url=base_url, api_key=api_key)
        self.model = model

    def intent_detection(self, message: str, context: Optional[Dict] = None) -> str:
        import re
        def is_today_query(msg):
            return "hari ini" in msg.lower()
        msg = message.lower()
        if context:
            # Tugas
            if ("tugas" in msg or "task" in msg) and context.get("tasks") is not None:
                tasks = context["tasks"]
                today = context.get("today")
                if is_today_query(message) and today:
                    today_tasks = [t for t in tasks if t.get("date") == today]
                    if today_tasks:
                        task_list = "\n".join([
                            f"- {t['title']} (Prioritas: {t.get('priority','-')}, Selesai: {'Ya' if t.get('completed') else 'Belum'})" for t in today_tasks
                        ])
                        return f"Tugas Anda hari ini ({today}):\n{task_list}"
                    else:
                        # Cari tugas terdekat berikutnya
                        future_tasks = sorted(
                            [t for t in tasks if t.get("date") and t.get("date") > today],
                            key=lambda x: x.get("date")
                        )
                        if future_tasks:
                            next_task = future_tasks[0]
                            return f"Hari ini tidak ada tugas. Tugas terdekat berikutnya:\n- {next_task['title']} pada {next_task['date']}"
                        else:
                            return "Hari ini tidak ada tugas dan tidak ada tugas mendatang."
                if not tasks:
                    return "Tidak ada tugas yang harus dikerjakan hari ini."
                task_list = "\n".join([
                    f"- {t['title']} (Prioritas: {t.get('priority','-')}, Selesai: {'Ya' if t.get('completed') else 'Belum'}, Tanggal: {t.get('date','-')})" for t in tasks
                ])
                return f"Tugas Anda:\n{task_list}"
            # Catatan
            if ("catatan" in msg or "note" in msg) and context.get("notes") is not None:
                notes = context["notes"]
                if not notes:
                    return "Tidak ada catatan."
                note_list = "\n\n".join([
                    f"Judul: {n['title']}\nIsi: {n.get('content','')}" for n in notes
                ])
                return f"Catatan Anda:\n{note_list}"
            # Keuangan
            if ("keuangan" in msg or "finance" in msg or "uang" in msg) and context.get("finances") is not None:
                finances = context["finances"]
                if not finances:
                    return "Tidak ada data keuangan."
                total_income = sum(f.get('amount',0) for f in finances if f.get('type') == 'income')
                total_expense = sum(f.get('amount',0) for f in finances if f.get('type') == 'expense')
                balance = total_income - total_expense
                finance_list = "\n".join([
                    f"- {f['type'].title()} Rp{f.get('amount',0):,.0f} [{f.get('category','-')}] {f.get('description','')} ({f.get('date','-')})" for f in finances
                ])
                return f"Ringkasan Keuangan:\nTotal pemasukan: Rp {total_income:,.0f}\nTotal pengeluaran: Rp {total_expense:,.0f}\nSaldo: Rp {balance:,.0f}\n\nDetail:\n{finance_list}"
            # Jurnal
            if ("jurnal" in msg or "journal" in msg) and context.get("journals") is not None:
                journals = context["journals"]
                if not journals:
                    return "Tidak ada entri jurnal."
                journal_list = "\n\n".join([
                    f"Judul: {j['title']}\nMood: {j.get('mood','-')}\nIsi: {j.get('content','')}\nTanggal: {j.get('created_at','-')}" for j in journals
                ])
                return f"Entri Jurnal Anda:\n{journal_list}"
        return "AI"

    def ai_chat_completion(self, user_message: str, system_prompt: Optional[str] = None, max_tokens: int = 256) -> str:
        """
        Mengirim prompt ke model AI dan mengembalikan response.
        """
        messages = []
        if system_prompt:
            messages.append({"role": "system", "content": system_prompt})
        messages.append({"role": "user", "content": user_message})
        completion = self.client.chat.completions.create(
            model=self.model,
            messages=messages,
            max_tokens=max_tokens,
            temperature=0.7,
            extra_headers={
                "HTTP-Referer": "http://localhost:8080",
                "X-Title": "AI Virtual Assistant"
            }
        )
        return completion.choices[0].message.content

    def chat(self, user_message: str, context: Optional[Dict] = None) -> str:
        """
        Facade utama: intent detection lalu fallback ke AI jika tidak terdeteksi.
        """
        intent_response = self.intent_detection(user_message, context)
        if intent_response != "AI":
            return intent_response
        system_prompt = "Kamu adalah asisten AI pribadi yang ramah dan membantu, jawab dalam bahasa Indonesia."
        return self.ai_chat_completion(user_message, system_prompt=system_prompt)

# --- Contoh Penggunaan ---
if __name__ == "__main__":
    import os
    import datetime
    # Cara 1: Isi API key langsung (tidak disarankan untuk produksi)
    # api_key = "sk-..."  # Ganti dengan API key asli Anda

    # Cara 2: Ambil dari environment variable (disarankan)
    api_key = os.getenv("OPENROUTER_API_KEY")
    if not api_key:
        api_key = input("Masukkan API Key OpenRouter/OpenAI: ")

    ai = AIChatbot(api_key=api_key)

    # Contoh context (data dummy, ganti dengan data dari database/backend Anda)
    context = {
        "today": datetime.date.today().isoformat(),
        "tasks": [
            {"title": "Tugas 1", "priority": "tinggi", "completed": False, "date": "2024-12-02"},
            {"title": "Tugas 2", "priority": "rendah", "completed": True, "date": datetime.date.today().isoformat()},
        ],
        "notes": [
            {"title": "Catatan A", "content": "Isi catatan A"},
            {"title": "Catatan B", "content": "Isi catatan B"},
        ],
        "finances": [
            {"type": "income", "amount": 1000000, "category": "Gaji", "description": "Gaji bulan Juni", "date": "2024-06-01"},
            {"type": "expense", "amount": 250000, "category": "Makan", "description": "Makan siang", "date": "2024-06-02"},
        ],
        "journals": [
            {"title": "Hari Produktif", "mood": "bahagia", "content": "Hari ini sangat produktif!", "created_at": "2024-06-09"},
        ]
    }

    # Contoh interaksi
    pertanyaan = "Apakah ada tugas hari ini?"
    response = ai.chat(pertanyaan, context=context)
    print(f"User: {pertanyaan}\nAI: {response}")

    pertanyaan2 = "Tampilkan semua tugas saya"
    response2 = ai.chat(pertanyaan2, context=context)
    print(f"User: {pertanyaan2}\nAI: {response2}") 