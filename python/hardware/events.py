from datetime import datetime

events = []


def add_event(message):
    events.append({
        "time": datetime.now().strftime("%H:%M:%S"),
        "message": message
    })


def get_events():
    return events[-10:]