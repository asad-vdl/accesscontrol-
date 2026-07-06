import pyttsx3


def speak(text):

    print(f"Speaking: {text}")

    try:

        engine = pyttsx3.init()

        engine.setProperty("rate", 160)

        engine.setProperty("volume", 1.0)

        engine.say(text)

        engine.runAndWait()

        engine.stop()

    except Exception as e:

        print("Voice Error:", e)