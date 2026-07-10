import threading
import pyttsx3


def _speak(text):
    try:
        print(f"Speaking: {text}")

        engine = pyttsx3.init()

        engine.setProperty("rate", 160)
        engine.setProperty("volume", 1.0)

        engine.say(text)
        engine.runAndWait()
        engine.stop()

    except Exception as e:
        print("Voice Error:", e)


def speak(text):
    threading.Thread(
        target=_speak,
        args=(text,),
        daemon=True
    ).start()