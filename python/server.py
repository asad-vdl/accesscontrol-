from access import process_access

from fastapi import FastAPI, Request, Form
from fastapi.responses import HTMLResponse
from fastapi.staticfiles import StaticFiles
from fastapi.templating import Jinja2Templates

from hardware.hardware import manual_open, manual_close


app = FastAPI(
    title="Smart Access Control"
)


# Static Folder
app.mount("/static", StaticFiles(directory="static"), name="static")


# Templates Folder
templates = Jinja2Templates(directory="templates")


# =========================
# HOME PAGE
# =========================

@app.get("/", response_class=HTMLResponse)
async def home(request: Request):

    return templates.TemplateResponse(
        request=request,
        name="index.html"
    )


# =========================
# DOOR CONTROL PAGE
# =========================

@app.get("/door", response_class=HTMLResponse)
async def door(request: Request):

    return templates.TemplateResponse(
        request=request,
        name="door.html",
        context={
            "door_status": "closed"
        }
    )


@app.post("/door/open", response_class=HTMLResponse)
async def open_door(request: Request):

    manual_open()

    return templates.TemplateResponse(
        request=request,
        name="door.html",
        context={
            "door_status": "open"
        }
    )


@app.post("/door/close", response_class=HTMLResponse)
async def close_door(request: Request):

    manual_close()

    return templates.TemplateResponse(
        request=request,
        name="door.html",
        context={
            "door_status": "closed"
        }
    )


# =========================
# CARD PAGE
# =========================

@app.get("/card", response_class=HTMLResponse)
async def card(request: Request):

    return templates.TemplateResponse(
        request=request,
        name="card.html"
    )


# =========================
# PIN PAGE
# =========================

@app.get("/pin", response_class=HTMLResponse)
async def pin(request: Request):

    return templates.TemplateResponse(
        request=request,
        name="pin.html"
    )


# =========================
# QR PAGE
# =========================

@app.get("/qr", response_class=HTMLResponse)
async def qr(request: Request):

    return templates.TemplateResponse(
        request=request,
        name="qr.html"
    )


# =========================
# FINGERPRINT PAGE
# =========================

@app.get("/fingerprint", response_class=HTMLResponse)
async def fingerprint(request: Request):

    return templates.TemplateResponse(
        request=request,
        name="fingerprint.html"
    )


# =========================
# CARD CHECK
# =========================

@app.post("/card", response_class=HTMLResponse)
async def check_card(
    request: Request,
    uid: str = Form(...)
):

    result = process_access("card", uid)

    return templates.TemplateResponse(
        request=request,
        name="result.html",
        context={
            "result": result
        }
    )


# =========================
# PIN CHECK
# =========================

@app.post("/pin", response_class=HTMLResponse)
async def check_pin(
    request: Request,
    pin: str = Form(...)
):

    result = process_access("pin", pin)

    return templates.TemplateResponse(
        request=request,
        name="result.html",
        context={
            "result": result
        }
    )


# =========================
# QR CHECK
# =========================

@app.post("/qr", response_class=HTMLResponse)
async def check_qr(
    request: Request,
    qr: str = Form(...)
):

    result = process_access("qr", qr)

    return templates.TemplateResponse(
        request=request,
        name="result.html",
        context={
            "result": result
        }
    )


# =========================
# FINGERPRINT CHECK
# =========================

@app.post("/fingerprint", response_class=HTMLResponse)
async def check_fingerprint(
    request: Request,
    fingerprint: str = Form(...)
):

    result = process_access("fingerprint", fingerprint)

    return templates.TemplateResponse(
        request=request,
        name="result.html",
        context={
            "result": result
        }
    )