import pyttsx3

engine = pyttsx3.init()

engine.setProperty("rate", 160)

engine.setProperty("volume", 1.0)


def speak(text):
    print(f"Speaking: {text}")
    engine.say(text)
    engine.runAndWait()